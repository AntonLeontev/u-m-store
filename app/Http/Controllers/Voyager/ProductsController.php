<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Bonus;
use App\Models\Category;
use App\Models\Directions;
use App\Models\Filters;
use App\Models\Options\Option;
use App\Models\Options\OptionValue;
use App\Models\Options\ProductOption;
use App\Models\Options\ProductOptionValue;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Product_to_store;
use App\Models\ProductsToFilters;
use App\Models\Store;
use App\Models\Product_to_category;
use Exception;
use http\Url;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

use function PHPUnit\Framework\isNull;
use Illuminate\Routing\UrlGenerator;

class ProductsController extends VoyagerBaseController
{
    use BreadRelationshipParser;

    public function index(Request $request)
    {

        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);


        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object)['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
//
        $searchNames = [];
        if ($dataType->server_side) {
            $searchNames = $dataType->browseRows->mapWithKeys(function ($row) {
                return [$row['field'] => $row->getTranslatedAttribute('display_name')];
            });
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType

        if (strlen($dataType->model_name) != 0) {

            $model = app($dataType->model_name);

            $query = $model::select($dataType->name . '.*');

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query->{$dataType->scope}();
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';

                $searchField = $dataType->name . '.' . $search->key;
                if ($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)) {
                    $query->whereIn(
                        $searchField,
                        $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray()

                    );

                } else {
                    if ($dataType->browseRows->pluck('field')->contains($search->key)) {
                        $query->where($searchField, $search_filter, $search_value);

                    }
                }
            }

//            Определяем выбранную категорию direction, если не выбрана то по умолчанию 1.

            if (is_null($request->direction_id)) {
                $direction_id = 1;
            } else $direction_id = $request->direction_id;

            //Если выбран store то фильтруем по нему тоже.
            $allStores = Store::all()->sortBy('real_name');
            $city_name = 0;
            if ($request->sity_name > 0) {
                $city_name = $request->sity_name;
                $sing = '=';
                $partner_id = $allStores->where('id', $city_name)->first()->partner_id;
                session()->put('partner_id', $partner_id);
            } else {
                $sing = '>';
                $partner_id = -1;
                session()->put('partner_id', $partner_id);
            }

            $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
            if ($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                if (!empty($row)) {
                    $query->select([
                        $dataType->name . '.*',
                        'joined.' . $row->details->label . ' as ' . $orderBy,
                    ])->leftJoin(
                        $row->details->table . ' as joined',
                        $dataType->name . '.' . $row->details->column,
                        'joined.' . $row->details->key
                    );
                }

                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder)->where('direction_id',
                        $direction_id)->where('partner_id', $sing, $partner_id),
                    $getter,
                ]);

            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT)->where('direction_id',
                    $direction_id)->where('partner_id', $sing, $partner_id),
                    $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC')->where('direction_id',
                    $direction_id)->where('partner_id', $sing, $partner_id), $getter]);

            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);

        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }
//
        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }
//

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        // Define list of columns that can be sorted server side
        $sortableColumns = $this->getSortableColumns($dataType->browseRows);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        $categories = Category::all();
        $allDirection = Directions::all();
        $allStores = Store::all()->sortBy('real_name');
//        Сохраняем в сессию текущие параметры поиска и фильтры get
        session()->put('urlback_search', url()->full());

        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortableColumns',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn',
            'showCheckboxColumn',
            'categories',
            'allDirection',
            'allStores',
            'direction_id',
            'partner_id',
            'city_name'
        ));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();

            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();


        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);


        $bonus_qty = Bonus::firstWhere('product_id', $dataTypeContent->id);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
//        Edit добавляем категории к товару.
        $product = Product::find($id);
        $allCategories = Category::all()->where('direction_id', $product->direction_id)->sortBy('name');

//        dd($product);
        //Получаем все категории товара
        $categories = $product->getCategory()->get();

        //Получаем все возможные опции для данного направления
        $options = Option::all()->where('direction_id', $product->direction_id)->sortBy('option_sort_order');
        $product_options = $product->getOptions()->where('partner_id', $product->partner_id)->get();
        $option_value = OptionValue::all()->where('direction_id', $request->direction_id);
        if (session()->get('partner_id') > 0) {
//            dd($id, $p_id);
            $product_option_value = DB::table('product_option_values')->
            where('product_id', $id)->
            where('partner_id', session()->get('partner_id'))
                ->join('options', 'option_id', '=', 'options.id')
                ->join('option_values', 'option_value_id', '=', 'option_values.id')
                ->select('product_option_values.*', 'options.option_name', 'option_values.name')
                ->get()->sortBy('option_id');

        } else {
            $product_option_value = 0;
        }


        $products_to_store = DB::table('product_to_stores')
//                ->join('partners', 'partner_id','=','partners.id')
            ->join('stores', 'store_id', '=', 'stores.id')
            ->select('product_to_stores.*', 'stores.real_name')
            ->where('product_id', $id)
            ->get()->sortBy('real_name');
//


        $allStores = Store::all()->sortBy('real_name');
        $allPartners = Partners::all();

//        Фильтры
        $filters = $product->getFilters()->get();
        $allFilters = Filters::all()->where('direction_id', $product->direction_id);
        return Voyager::view($view,
            compact('dataType',
                'dataTypeContent',
                'isModelTranslatable',
                'bonus_qty',
                'allCategories',
                'categories',
                'options',
                'product',
                'product_options',
                'option_value',
                'id',
                'product_option_value',
                'products_to_store',
                'allStores',
                'allPartners',
                'filters', 'allFilters'
            ));
    }

//    /**Custom function
//     * Фильтры товара
//     */
//    public function getFilter($product_id){
//        $this->allFilters = Filters::all();
//        $this->protuctFilter = ProductsToFilters::where('product_id', $product_id);
//
//    }
    /**Custom function
     * Ответ на запрос ajax получить значения выбранной опции
     */
    public function getOptionsValue(Request $request)
    {

        $option_value = OptionValue::all()->where('option_id', $request->option_value_id);

        $data = json_encode($option_value);
        echo $data;
    }

    /**Custom function
     * Ответ на запрос ajax получить партнера в городе
     */
    public function getPartners(Request $request)
    {

        $partner_name = DB::table('partners')->where('store_id', $request->store_id)->get();

        echo json_encode($partner_name);
    }

    /**Custom function
     * Ответ на запрос ajax удалить опцию в таблице "product_option_value"
     */
    public function delOptionValue(Request $request)
    {

        $product_option_id = DB::table('product_option_values')
            ->where('id', $request->option_value_id)
            ->first()->product_option_id;
        DB::table('product_option_values')
            ->where('id', $request->option_value_id)
            ->delete();
        //Проверка на отсутсвия опции у товара и удаление из таблицы product_options.
        $count = DB::table('product_option_values')->where('product_option_id', $product_option_id)->count('product_option_id');
        if ($count == 0) {
            DB::table('product_options')->where('id', $product_option_id)->delete();
            return 'product_option удалена';
        } else return ('product_option не удален');

    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $slug = $this->getSlug($request);

        $bonus_qty = Bonus::firstWhere('product_id', $id);
        if ($bonus_qty) {
            $bonus_qty->qty = $request->bonus_qty;
            $bonus_qty->save();
        } else {
            $this->setBonus($id, 0, $request->bonus_qty);
        }


        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataType->editRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone($data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
//            Добавил редирек на прошлую страницу поиска
            $redirect = redirect()->to(session('urlback_search'));

        } else {
            $redirect = redirect()->back();
        }

        $product = Product::firstWhere('partner_id', NULL);
        if ($product) {
            $product->partner_id = 0;
            $product->save();
        }
        //Проверка для общих букетов.
        if ($request->partner_id != null) {
            // Добавление (удаление) фильтров к товару
            $this->addDelFilter($request, $id);
            //Добавление (удаление) категорий к товару
            $this->addDelCategory($request, $id);

//        Добавление цен в города или удаление
            if ($request->total_price && $request->total_price > 0) {
                $this->totalPrice($request, $id);
            } elseif ($request->store_id_price) {
                $this->newPriceForCity($request, $id);
            }

//        Обновление цен на опции у партнера
            if ($request->partner_price) {
                $this->optionPriceUpdate($request, $id);
            }
//
            if ($request->option_id_new) {

                $this->newOptionAdd($request, $id);
            }
        }
//
        return $redirect->with([
            'message' => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    /**Custom function
     * Функция добавление (удаление) категории к товару
     * "products_to_filters"
     */
    public function addDelCategory($request, $id)
    {
        //Удаляем старые записи категорий
        Product_to_category::where('product_id', $id)->delete();
        // Добавление товара в категорию
        if ($request->categorySelected) {
            //           Добавляем новые записи
            foreach ($request->categorySelected as $category) {
                Product_to_category::create([
                    'product_id' => $id,
                    'category_id' => $category,
                ]);
            }
        }
    }

    /**Custom function
     * Функция добавление (удаление) фильтра к товару
     * "products_to_filters"
     */
    public function addDelFilter($request, $id)
    {
        //Удаляем старые записи фильтров
        ProductsToFilters::where('product_id', $id)->delete();
        // Добавление товара к фильтру
        if ($request->filterSelected) {
            //           Добавляем новые записи
            foreach ($request->filterSelected as $filter) {
                ProductsToFilters::create([
                    'product_id' => $id,
                    'filter_id' => $filter,
                ]);
            }
        }
    }

    /**Custom function
     * Функция добавления новой опции
     * в таблице "product_option_values"
     */
    public function newOptionAdd(Request $request, $id)
    {

        $store_id = Partners::find($request->partner_id)->store_id;
        foreach ($request->option_price_new as $key => $partner_price) {
            if ($partner_price > 0) {
                $product_option_id = ProductOption::updateOrCreate([
                    'store_id' => $store_id,
                    'partner_id' => $request->partner_id,
                    'product_id' => $id,
                    'option_id' => $request->option_id_new[$key],

                ],
                    [
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]
                )->id;

                $id_db = DB::table('product_option_values')->insertGetId([
                    'store_id' => $store_id,
                    'partner_id' => $request->partner_id,
                    'product_option_id' => $product_option_id,
                    'product_id' => $id,
                    'option_id' => $request->option_id_new[$key],
                    'option_value_id' => $key,
                    'quantity' => 1000,
                    'subtract' => 1,
                    'partner_price' => $partner_price,
                    'price' => $partner_price,
                    'price_prefix' => '=',
                    'points' => 0,
                    'points_prefix' => '+',
                    'weight' => 0,
                    'weight_prefix' => '+',
                ]);

            }


        }
    }

    /**Custom function
     * Функция обновления цены на опции
     * в таблице "product_option_values"
     */
    public function optionPriceUpdate(Request $request, $id)
    {
        foreach ($request->partner_price as $key => $partner_price)
            $partner_price = preg_replace('/[^0-9]/', '', $partner_price);
        ProductOptionValue::find($key)->update([
            'partner_price' => $partner_price,
            'price' => ceil((Partners::find($request->partner_id)->markup / 100 + 1) * $partner_price)
        ]);
//                        Поля для проверки существования записи


    }

    public function totalPrice(Request $request, $id)
    {

        $partners = Partners::where('direction_id', $request->direction_id)->get();
        $price = $request->total_price;

        if ($partners) {
            foreach ($partners as $partner) {
                Product_to_store::updateOrCreate(
                //                        Поля для проверки существования записи
                    [
                        'product_id' => $id,
                        'store_id' => $partner->store_id,
                        'partner_id' => $partner->id,

                    ],
                    //                            Обновляем время и цену если запись есть и создаем если нет.
                    [
                        'partner_price' => $price,
                        'store_price' => ceil(($partner->markup / 100 + 1) * $price),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]

                );
            }
        }
    }


    /**Custom function
     * Функция обновления или создания
     * в случае отсутствия цены в выбранном городе в таблице
     * "product_to_store"
     */
    public function newPriceForCity(Request $request, $id)
    {
        if (($store_id_price = $request->store_id_price) && ($partner_id_price = $request->partner_id_price)) {
            $partner_price_new = $request->partner_price_new;
            foreach ($partner_price_new as $partner_id => $price) {
                $price = preg_replace('/[^0-9]/', '', $price);
                if ($price > 0 && $partner_id > 0) {

                    $markup = DB::table('partners')->where('id', $partner_id)->value('markup');
                    $decMarkup =  !is_null($markup) ?  $markup / 100 : 0.15;

//                Создаем или обновляем цену на товар если цена больше 0
                    Product_to_store::updateOrCreate(
//                        Поля для проверки соществования записи
                        [
                            'product_id' => $id,
                            'store_id' => $store_id_price[$partner_id],
                            'partner_id' => $partner_id,


                        ],
//                            Обновляем время и цену если запись есть и создаем если нет.
                        [
                            'partner_price' => $price,
//                            'store_price' => ceil((Partners::find($partner_id)->markup / 100 + 1) * $price),
                            'store_price' => ceil($decMarkup * $price) + $price,
                            'updated_at' => date("Y-m-d H:i:s"),
                        ]

                    );

                } //            Удаление цен из базы
                elseif (($price == 0 or $price == '') && $partner_id > 0) {
                    Product_to_store::where([
                        'product_id' => $id,
                        'store_id' => $store_id_price[$partner_id],
                        'partner_id' => $partner_id,
                    ])->delete();
                }
            }
        }
    }
    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        $bonus_qty = new Bonus();


        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
//
        $allCategories = Category::all()->sortBy('name');
        $categories = collect([]);
        $product = new Product();
        $id = 0;

        $allStores = Store::all()->sortBy('real_name');
        $allPartners = Partners::all();

        //        Фильтры
        $filters = collect([]);
        $allFilters = Filters::all();

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'bonus_qty',
            'allCategories',
            'categories',
            'allStores',
            'id',
            'allPartners',
            'allFilters',
            'filters',
            'product'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with aja
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
        $product = Product::firstWhere('partner_id', NULL);
        if ($product) {
            $product->partner_id = 0;
            $product->save();
        }

        $this->setBonus($data->id, 0, $request->bonus_qty);

        event(new BreadDataAdded($dataType, $data));
        if ($request->categorySelected) {


//           Создаем новую запись
            foreach ($request->categorySelected as $category) {
                Product_to_category::create([
                    'product_id' => $data->id,
                    'category_id' => $category,
                ]);
            }
        }

        //        Добавление цен в города или удаление
        if ($request->total_price && $request->total_price > 0) {
            $this->totalPrice($request, $data->id);

        } elseif ($request->store_id_price) {
            $this->newPriceForCity($request, $data->id);
        }
//        Обновление цен на опции у партнера
        if ($request->partner_price) {
            $this->optionPriceUpdate($request, $data->id);
        }
//
        if ($request->option_id_new) {

            $this->newOptionAdd($request, $data->id);
        }

//        if($request->selectPartner)
//        {
//           $product =  Product::find($data->id);
//           if($product)
//           {
//               $product->partner_id = $request->selectPartner;
//               $product->save();
//           }
//        }


        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message' => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    private function setBonus($product_id, $store_id = 0, $bonus_qty)
    {
        $bonus = new Bonus();
        $bonus->product_id = $product_id;
        $bonus->store_id = $store_id;
        $bonus->qty = $bonus_qty;
        $bonus->save();
    }
    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();


//         Bonus::firstWhere('product_id', $id)->delete();
        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }

        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            // Check permission
            $this->authorize('delete', $data);
            //Выключаем проверку внешних ключей
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $model = app($dataType->model_name);
            if (!($model && in_array(SoftDeletes::class, class_uses_recursive($model)))) {
                $this->cleanup($dataType, $data);
            }
            //удаляем все в ручную
            Product_to_store::where('product_id', $id)->delete();
            Product_to_category::where('product_id', $id)->delete();
            ProductOption::where('product_id', $id)->delete();
            ProductOptionValue::where('product_id', $id)->delete();
            ProductsToFilters::where('product_id', $id)->delete();
            DB::table('media')->where('product_id', $id)->delete();
        }

        $displayName = count($ids) > 1 ? $dataType->getTranslatedAttribute('display_name_plural') : $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->destroy($ids);
        $data = $res
            ? [
                'message' => __('voyager::generic.successfully_deleted') . " {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message' => __('voyager::generic.error_deleting') . " {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataDeleted($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }


    public function restore(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $model = app($dataType->model_name);
        $this->authorize('delete', $model);

        // Get record
        $query = $model->withTrashed();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        $data = $query->findOrFail($id);

        $displayName = $dataType->getTranslatedAttribute('display_name_singular');

        $res = $data->restore($id);
        $data = $res
            ? [
                'message' => __('voyager::generic.successfully_restored') . " {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message' => __('voyager::generic.error_restoring') . " {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataRestored($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    //***************************************
    //
    //  Delete uploaded file
    //
    //****************************************

    public function remove_media(Request $request)
    {
        try {
            // GET THE SLUG, ex. 'posts', 'pages', etc.
            $slug = $request->get('slug');

            // GET file name
            $filename = $request->get('filename');

            // GET record id
            $id = $request->get('id');

            // GET field name
            $field = $request->get('field');

            // GET multi value
            $multi = $request->get('multi');

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Load model and find record
            $model = app($dataType->model_name);
            $data = $model::find([$id])->first();

            // Check if field exists
            if (!isset($data->{$field})) {
                throw new Exception(__('voyager::generic.field_does_not_exist'), 400);
            }

            // Check permission
            $this->authorize('edit', $data);

            if (@json_decode($multi)) {
                // Check if valid json
                if (is_null(@json_decode($data->{$field}))) {
                    throw new Exception(__('voyager::json.invalid'), 500);
                }

                // Decode field value
                $fieldData = @json_decode($data->{$field}, true);
                $key = null;

                // Check if we're dealing with a nested array for the case of multiple files
                if (is_array($fieldData[0])) {
                    foreach ($fieldData as $index => $file) {
                        // file type has a different structure than images
                        if (!empty($file['original_name'])) {
                            if ($file['original_name'] == $filename) {
                                $key = $index;
                                break;
                            }
                        } else {
                            $file = array_flip($file);
                            if (array_key_exists($filename, $file)) {
                                $key = $index;
                                break;
                            }
                        }
                    }
                } else {
                    $key = array_search($filename, $fieldData);
                }

                // Check if file was found in array
                if (is_null($key) || $key === false) {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }

                $fileToRemove = $fieldData[$key]['download_link'] ?? $fieldData[$key];

                // Remove file from array
                unset($fieldData[$key]);

                // Generate json and update field
                $data->{$field} = empty($fieldData) ? null : json_encode(array_values($fieldData));
            } else {
                if ($filename == $data->{$field}) {
                    $fileToRemove = $data->{$field};

                    $data->{$field} = null;
                } else {
                    throw new Exception(__('voyager::media.file_does_not_exist'), 400);
                }
            }

            $row = $dataType->rows->where('field', $field)->first();

            // Remove file from filesystem
            if (in_array($row->type, ['image', 'multiple_images'])) {
                $this->deleteBreadImages($data, [$row], $fileToRemove);
            } else {
                $this->deleteFileIfExists($fileToRemove);
            }

            $data->save();

            return response()->json([
                'data' => [
                    'status' => 200,
                    'message' => __('voyager::media.file_removed'),
                ],
            ]);
        } catch (Exception $e) {
            $code = 500;
            $message = __('voyager::generic.internal_error');

            if ($e->getCode()) {
                $code = $e->getCode();
            }

            if ($e->getMessage()) {
                $message = $e->getMessage();
            }

            return response()->json([
                'data' => [
                    'status' => $code,
                    'message' => $message,
                ],
            ], $code);
        }
    }

    /**
     * Remove translations, images and files related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $dataType
     * @param \Illuminate\Database\Eloquent\Model $data
     *
     * @return void
     */
    protected function cleanup($dataType, $data)
    {
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // Delete Images
        $this->deleteBreadImages($data, $dataType->deleteRows->whereIn('type', ['image', 'multiple_images']));

        // Delete Files
        foreach ($dataType->deleteRows->where('type', 'file') as $row) {
            if (isset($data->{$row->field})) {
                foreach (json_decode($data->{$row->field}) as $file) {
                    $this->deleteFileIfExists($file->download_link);
                }
            }
        }

        // Delete media-picker files
        $dataType->rows->where('type', 'media_picker')->where('details.delete_files', true)->each(function ($row) use ($data) {
            $content = $data->{$row->field};
            if (isset($content)) {
                if (!is_array($content)) {
                    $content = json_decode($content);
                }
                if (is_array($content)) {
                    foreach ($content as $file) {
                        $this->deleteFileIfExists($file);
                    }
                } else {
                    $this->deleteFileIfExists($content);
                }
            }
        });
    }

    /**
     * Delete all images related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $data
     * @param \Illuminate\Database\Eloquent\Model $rows
     *
     * @return void
     */
    public function deleteBreadImages($data, $rows, $single_image = null)
    {
        $imagesDeleted = false;

        foreach ($rows as $row) {
            if ($row->type == 'multiple_images') {
                $images_to_remove = json_decode($data->getOriginal($row->field), true) ?? [];
            } else {
                $images_to_remove = [$data->getOriginal($row->field)];
            }

            foreach ($images_to_remove as $image) {
                // Remove only $single_image if we are removing from bread edit
                if ($image != config('voyager.user.default_avatar') && (is_null($single_image) || $single_image == $image)) {
                    $this->deleteFileIfExists($image);
                    $imagesDeleted = true;

                    if (isset($row->details->thumbnails)) {
                        foreach ($row->details->thumbnails as $thumbnail) {
                            $ext = explode('.', $image);
                            $extension = '.' . $ext[count($ext) - 1];

                            $path = str_replace($extension, '', $image);

                            $thumb_name = $thumbnail->name;

                            $this->deleteFileIfExists($path . '-' . $thumb_name . $extension);
                        }
                    }
                }
            }
        }

        if ($imagesDeleted) {
            event(new BreadImagesDeleted($data, $rows));
        }
    }

    /**
     * Order BREAD items.
     *
     * @param string $table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        if (empty($dataType->order_column) || empty($dataType->order_display_column)) {
            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message' => __('voyager::bread.ordering_not_set'),
                    'alert-type' => 'error',
                ]);
        }

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }
        $results = $query->orderBy($dataType->order_column, $dataType->order_direction)->get();

        $display_column = $dataType->order_display_column;

        $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

        $view = 'voyager::bread.order';

        if (view()->exists("voyager::$slug.order")) {
            $view = "voyager::$slug.order";
        }

        return Voyager::view($view, compact(
            'dataType',
            'display_column',
            'dataRow',
            'results'
        ));
    }

    public function update_order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        $model = app($dataType->model_name);

        $order = json_decode($request->input('order'));
        $column = $dataType->order_column;
        foreach ($order as $key => $item) {
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $i = $model->withTrashed()->findOrFail($item->id);
            } else {
                $i = $model->findOrFail($item->id);
            }
            $i->$column = ($key + 1);
            $i->save();
        }
    }

    public function action(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $action = new $request->action($dataType, null);

        return $action->massAction(explode(',', $request->ids), $request->headers->get('referer'));
    }

    /**
     * Get BREAD relations data.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $method = $request->input('method', 'add');

        $model = app($dataType->model_name);
        if ($method != 'add') {
            $model = $model->find($request->input('id'));
        }

        $this->authorize($method, $model);

        $rows = $dataType->{$method . 'Rows'};
        foreach ($rows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $model = app($options->model);
                $skip = $on_page * ($page - 1);

                $additional_attributes = $model->additional_attributes ?? [];

                // Apply local scope if it is defined in the relationship-options
                if (isset($options->scope) && $options->scope != '' && method_exists($model, 'scope' . ucfirst($options->scope))) {
                    $model = $model->{$options->scope}();
                }

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    // If we are using additional_attribute as label
                    if (in_array($options->label, $additional_attributes)) {
                        $relationshipOptions = $model->all();
                        $relationshipOptions = $relationshipOptions->filter(function ($model) use ($search, $options) {
                            return stripos($model->{$options->label}, $search) !== false;
                        });
                        $total_count = $relationshipOptions->count();
                        $relationshipOptions = $relationshipOptions->forPage($page, $on_page);
                    } else {
                        $total_count = $model->where($options->label, 'LIKE', '%' . $search . '%')->count();
                        $relationshipOptions = $model->take($on_page)->skip($skip)
                            ->where($options->label, 'LIKE', '%' . $search . '%')
                            ->get();
                    }
                } else {
                    $total_count = $model->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)->get();
                }

                $results = [];

                if (!$row->required && !$search && $page == 1) {
                    $results[] = [
                        'id' => '',
                        'text' => __('voyager::generic.none'),
                    ];
                }

                // Sort results
                if (!empty($options->sort->field)) {
                    if (!empty($options->sort->direction) && strtolower($options->sort->direction) == 'desc') {
                        $relationshipOptions = $relationshipOptions->sortByDesc($options->sort->field);
                    } else {
                        $relationshipOptions = $relationshipOptions->sortBy($options->sort->field);
                    }
                }

                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id' => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results' => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }

    protected function findSearchableRelationshipRow($relationshipRows, $searchKey)
    {
        return $relationshipRows->filter(function ($item) use ($searchKey) {
            if ($item->details->column != $searchKey) {
                return false;
            }
            if ($item->details->type != 'belongsTo') {
                return false;
            }

            return !$this->relationIsUsingAccessorAsLabel($item->details);
        })->first();
    }

    protected function getSortableColumns($rows)
    {
        return $rows->filter(function ($item) {
            if ($item->type != 'relationship') {
                return true;
            }
            if ($item->details->type != 'belongsTo') {
                return false;
            }

            return !$this->relationIsUsingAccessorAsLabel($item->details);
        })
            ->pluck('field')
            ->toArray();
    }

    protected function relationIsUsingAccessorAsLabel($details)
    {
        return in_array($details->label, app($details->model)->additional_attributes ?? []);
    }
}
