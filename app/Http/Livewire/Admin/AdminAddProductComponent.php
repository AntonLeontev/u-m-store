<?php

namespace App\Http\Livewire\Admin;
use App\Jobs\ChainApi\MarketplaceCreateProduct;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Store;
use App\Models\UserWallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    // трейт необходим для загрузки изображений
	use WithFileUploads;


    public $name;
    public $images;
    public $additional_images = []; // доп.добавление изображений
    public $edit_images = []; // изображение для редактирования
    public $price;
    public $markup_price;
    public $discount;
    public $markup;
    public $description;
    public $sFilters = [];
    public $sCategories = [];
    public $video_links = []; // инпуты для ссылок с видео
    public $additional_categories = [];
    public $compounds = []; // состав товара
    public $parameters = []; // параметры товара
    public $specifications = []; // тех.характеристики
    public $materials = []; // материалы
    public $add_info = []; // доп информация
    public $additional_infos = []; // доп. поля информации
    public $another_opt = []; // другие функции
    // public $quantity;
    // public $options;

    public bool $user_role;
    public $product_id;

    // связка поле -> таблица
    const FIELD_TABLE = [
        'compounds' => 'products_to_compound',
        'parameters' => 'products_to_parameters',
        'specifications' => 'products_to_specifications',
        'materials' => 'products_to_materials',
        'add_info' => 'products_to_info',
        'additional_infos' => 'products_to_additional_info',
        'another_opt' => 'products_to_another_opt',
    ];

    /*
     * запускается один раз при загрузки страницы
     */
    public function mount() {
        $role_id = Auth::user()->role_id;
        $this->user_role = $role_id == 1 || $role_id == 3;
        $this->discount = 0; // скидку сделаем обязательной, но по умолчанию 0
        $this->markup = $this->getMarkup();
        $this->markup_price = 0;
    }

    /*
     * меняет старую цену при каждом post запросе
     */
    public function changeMarkupPrice() {

        // валидируем перед тем как устанавливать цену
        $this->markup_price = $this->getMarkupPrice((int)$this->price);
    }

    /**
     * уменьшает/увеличивает кол-во состава
     * @param $cmpKey
     * @param $inc
     * @return void
     */
    public function changeCompoundNum($cmpKey, $inc = 1) {
        // если требуется выполнить инкремент
        if($inc == 1) {
            $this->compounds[$cmpKey]['number']++;
        // если равно нулю то меньше нуля нельзя
        } else if($this->compounds[$cmpKey]['number'] == 0) {
            $this->compounds[$cmpKey]['number'] = 0;
        // иначе делаем декримент
        } else {
            $this->compounds[$cmpKey]['number']--;
        }
    }

    /*
     * добававить категорию
     */
    public function addCategory() {

        $this->additional_categories[] = ['name' => null];
    }

    /**
     * добавить еще одно поле доп.информации
     */
    public function addAdditionalInfos() {

        $this->additional_infos[] = ['additional_info' => null];
    }

    /*
    * добавить составляющее
    */
    public function addCompound() {

        $this->compounds[] = ['compound' => null, 'number' => 0];
    }

    /*
     * добавляем спецификацию
     */
    public function addSpecification() {

        $this->specifications[] = ['specification' => null];
    }

    public function addMaterial() {

        $this->materials[] = ['material' => null];
    }

    /*
     * добавить видео для товара
     */
    public function addVideoLink() {

        $this->video_links[] = ['video_link' => ''];
    }

    /**
     * добавлят еще изображений когда это необходимо
     * @return bool
     */
    public function addMoreImages() {

        if(!empty($this->additional_images)) {
            $this->images = array_merge($this->images, $this->additional_images);
            return true;
        }
        return false;
    }

    /*
     * Получает наценку партнера для текущего поль-ля
     */
    public function getMarkup() {

        return DB::table('users')
            ->leftJoin('partners', 'users.partner_id', '=', 'partners.id')
            ->where('users.id', Auth::id())->value('markup');
    }

    /**
     * валидация
     * @var string[]
     */
    protected $rules = [
        'name' => 'required|min:5',
        'price' => 'required|not_in:0',
        'additional_categories.*.name' => 'required|max:20',
        'additional_infos.*.additional_info' => 'required|max:20',
        'compounds.*.compound' => 'required|max:20',
        'compounds.*.number' => 'not_in:0',
        'specifications.*.specification' => 'required',
        'materials.*.material' => 'required',
        'discount' => 'required|lt:100',
        'description' => 'max:2000',
        'images' => 'required|array|max:10', // максимально 10 фотографий
        'images.*' => 'mimes:jpeg,jpg,png,webp|max:10000',
        'video_links.*.video_link' => 'required|url',
        // 'sFilters' => 'max:3',
        // 'sCategories' => 'max:3',
    ];

    /**
     * сообщения валидации
     * @var string[]
     */
    protected $messages = [
        'name.required' => 'Необходимо указать название товара',
        'price.required' => 'Необходимо указать цену',
        'price.not_in' => 'Цена не может быть отрицательной либо равной нулю',
        'discount.required' => 'Укажите скидку для старой цены (если ее нет, то укажите 0)',
        'discount.lt' => 'Cкидка не может быть больше 100%',
        'description.max' => 'Максимально количество символов: 2000',
        // фотографии
        'images.required' => 'Необходимо загрузить хотя бы одну фотографию',
        'images.max' => 'У товара может быть не более 10 фотографий',
        'images.*.mimes' => 'Поддерживаются следующие форматы изображений: jpeg,jpg,png',
        'images.*.max' => 'Максимальный размер фотографии не более 10000kb',
        // 'sFilters.max' => 'Можно указать не более 3еx фильтров для товара',
        // 'sCategories.max' => 'Можно указать не более 3ex категорий для товара',
        'video_links.max' => 'Для товара можно добавить не более 3ex видеороликов',
        // 'video_links.*.url' => 'Допускается указывать только ссылку',
        'additional_categories.*.name.required' => 'Необходимо указать название новой категории',
        'additional_categories.*.name.max' => 'Название новой категории не может быть больше 20 символов',
        'compounds.*.compound.required' => 'Необходимо указать название компонента',
        'compounds.*.compound.max' => 'Название компонента не может быть больше 20 символов',
        'compounds.*.number.not_in' => 'Кол-во компонента не может быть равно нулю',
        'specifications.*.specification.required' => 'Необходимо указать тех.характеристику',
        'materials.*.material.required' => 'Необходимо указать материал',
        'additional_infos.*.additional_info.required' => 'Необходимо указать дополнительную информацию',
        'additional_infos.*.additional_info.max' => 'Дополнительная информация не может быть больше 20 cимволов',
        'video_links.*.video_link.url' => 'Указанное значение должно быть ссылкой',
        'video_links.*.video_link.required' => 'Необходимо указать ccылку на видео товара',
    ];

    /**
     * Real-time валидация
     * @param $propertyName
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {

        // можно указать не более трех фильтров
        // if(count($this->sFilters) > 3) $this->addError('over_filter_count', 'Можно указать не более трех фильтров');
        // if(count($this->sCategories) > 3) $this->addError('over_category_count', 'Можно указать не более трех категорий');

        $this->validateOnly($propertyName);

        // если добавились новые фотографии
        if($propertyName == 'additional_images') $this->addMoreImages();

        // если нужно редактировать фотографию
        if(str_contains($propertyName, 'edit_image')) $this->editTmpFile();

    }


    public function updateImages() {

        // папка сохранения изображений
        $folder_with_month = Carbon::now()->format('FY');
        if($this->images) {
            foreach($this->images as $key =>$image) {
                if($image && is_object($image)) {

                    $timestamp = Carbon::now()->timestamp;
                    $image_path_800 = $this->resizeImg($image, 800, $folder_with_month, $timestamp);
                    $image_path_300 = $this->resizeImg($image, 300, $folder_with_month, $timestamp);


					DB::table('media')->insert([
						'image_path' => $image_path_800,
						'resize_image_path' => $image_path_300,
						'product_id' => $this->product_id,
						'created_at' => now(),
						'updated_at' => now()
					]);

                }
            }
            // add main image

                $main_img_path = DB::table('media')->select('resize_image_path')->where('product_id', $this->product_id)->first();
                if ($main_img_path && $main_img_path->resize_image_path) {
                    DB::table('products')
                        ->where('id', $this->product_id)->update([
                            'image' => $main_img_path->resize_image_path
                        ]);
                }
        }
        // сообщение об обновлении описания
        session()->flash('update_image', 'Изображения товара успешно обновлены!');
    }
    
    private function resizeImg($image, $resize_px, $folder_with_month, $timestamp) {


        if($image) {

            $preview_folder = $resize_px == 300 ? '/preview/' : '/';
            $imgName = $timestamp . "_".$resize_px."px." . $image->extension();
            $path = public_path('storage/products/'.$folder_with_month . "$preview_folder");
            $image_path = public_path('storage/products/'.$folder_with_month . "$preview_folder" . $imgName);

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if($resize_px == 300 ) {
                Image::make($image->temporaryUrl())->fit(260, 300)->save($image_path);
            } else {
                Image::make($image->temporaryUrl())->save($image_path);
            }
            return 'products/'. $folder_with_month .$preview_folder. $imgName;
        }
        return false;
    }
    /**
     * основной метод создания продукта
     * @return false
     */
    public function addProduct() {

        // валидируем полученные данные
        $this->validate();
        if($this->images && count($this->images) == 0) {
            session()->flash('images', 'Нужно добавить фото');
            $this->emit('refreshComponent');
            return false;
        }


        // если пользователь типа админ
        if(Auth::user()->utype == 'ADM') {
            // создаем новый продукт и галлерею продукта для него
            $this->product_id = $this->newProduct();
//            updateOrCreateProductGallery($this->images, $this->product_id);

            $this->updateImages();

            // продукт к городу
            $this->productToStores();
            // фильтры продукта
            $this->productToFilters();
            // категории продукта
            $this->productToCategories();
            // опции продукта
            // $this->setOptions();
            // добавляем доп.информацию для продукта, если она есть
            foreach(self::FIELD_TABLE as $field => $table) {
                $this->addToTable($table);
            }

            session()->flash('message', 'Товар успешно добавлен!');
            $this->redirect(route('admin.products'));
        }
    }

    /**
     * @return bool
     */
    private function productToStores() {
        //product id нужен для регистрации товара в блокчейне.
        $product_id = DB::table('product_to_stores')->insertGetId([
            'product_id' => $this->product_id,
            'store_id' => $this->getPartnerByUserRole()->store_id,
            'partner_id' => $this->getPartnerByUserRole()->id,
            'store_price' => $this->price,
            'discount' => $this->discount,
            'partner_price' => $this->getMarkupPrice($this->price),
            'store_old_price' => $this->discount > 0 ? $this->getMarkupPrice($this->price, true) : 0,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);
        //Получаем кошелек партнера из базы данных

        $wallet_address = UserWallet::firstWhere('user_id',Auth::id());
        if($wallet_address) {
            //Запускаем очередь регистрации созданного товара в блокчейне
            MarketplaceCreateProduct::dispatch($product_id, $this->price, $wallet_address->wallet_address);
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    private function productToFilters() {

        $product_to_filters = DB::table('products_to_filters');

        // добавляем фильтры продукта
        if(count($this->sFilters) > 0)  {
            // удаляем фильтры продукта если они есть
            $product_to_filters->where('product_id', $this->product_id)
                ->delete();
            // добавляем новые фильтры
            foreach($this->sFilters as $filter_id) {
                $product_to_filters->insert([
                    'product_id' => $this->product_id,
                    'filter_id' => $filter_id
                ]);
            }
        }
        return true;
    }

    /**
     * добавление опций товара
     * @return void
     */
    private function setOptions() {

    }


    /**
     * @param $tableName
     * @return bool
     */
    private function addToTable($tableName) {

        $add = [];

        switch($tableName) {
            case 'products_to_compound':

                if(empty($this->compounds)) break;

                foreach($this->compounds as $data)  {

                    // не добавляем составы у которых значение равно 0
                    // либо пустое значение compound
                    if($data['number'] == 0 || empty($data['compound'])) continue;

                    $add[] = [
                        'product_id' => $this->product_id,
                        'compound' => $data['compound'],
                        'number' => $data['number']
                    ];
                }

            break;
            case 'products_to_parameters':

                if(empty($this->parameters)) break;

                $add['product_id'] = $this->product_id;

                foreach($this->parameters as $key => $value) {
                    $add[$key] = $value;
                }

            break;
            case 'products_to_specifications':

                if(empty($this->specifications)) break;

                    foreach($this->specifications as $key => $value) {

                        // не добавляем пустые тех характеристики
                        if(empty($value['specification'])) continue;

                        $value['product_id'] = $this->product_id;
                        $value['created_at'] = now();
                        $value['updated_at'] = now();

                        $add[$key] = $value;
                }


            break;
            case 'products_to_materials':

                if(empty($this->materials)) break;

                foreach($this->materials as $key => $value) {

                    // не добавляем пустые материалы
                    if(empty($value['material'])) continue;

                    $value['product_id'] = $this->product_id;
                    $value['created_at'] = now();
                    $value['updated_at'] = now();

                    $add[$key] = $value;

                }

            break;
            case 'products_to_info':

                // если не указана доп.информация и ссылка на видео
                if(empty($this->add_info) && empty($this->video_links)) break;

                $add['product_id'] = $this->product_id;
                $value['created_at'] = now();
                $value['updated_at'] = now();

                // доп. информация
                foreach($this->add_info as $key => $value) {
                    $add[$key] = $value;
                }

                $unique_video_links = [];
                foreach($this->video_links as $key => $value) {
                    // извлекаем полученную ссылку
                    $url = array_shift($value);
                    // убираем дублирующиеся видео
                    if(in_array($url, $unique_video_links)) continue;
                    $unique_video_links[] = $url;
                }
                // ссылки на видео (преобразовать в json массив и сохранить)
                if(!empty($unique_video_links)) $add['video_links'] = json_encode($unique_video_links);

            break;
            case 'products_to_additional_info':

                if(empty($this->additional_infos)) break;

                foreach($this->additional_infos as $key => $value) {

                    // не добавляем пустую доп. информацию
                    if(empty($value['additional_info'])) continue;

                    $value['product_id'] = $this->product_id;
                    $value['created_at'] = now();
                    $value['updated_at'] = now();

                    $add[$key] = $value;
                }

            break;
            case 'products_to_another_opt':

                $add['product_id'] = $this->product_id;
                $add['fragile'] = 'fragile';
                $add['transportation'] = 'danger';
                $add['created_at'] = now();
                $add['updated_at'] = now();

                // если не редактировал это поле, то ставим его дефолту
                if(!empty($this->another_opt)) {
                    foreach($this->another_opt as $key => $value) {
                        $add[$key] = $value;
                    }
                }
            break;
            default:
                return false;
        }

        DB::table($tableName)->insert($add);
        return true;
    }

    /**
     * @return bool
     */
    private function productToCategories() {

        $product_to_cateory = DB::table('product_to_categories');
        $categories = DB::table('categories');
        $new_categories_id = [];

        // добавляем новые категории в таблицу категорий и получаем их id
        foreach($this->additional_categories as $value) {

            // если случайно попала пустая категория, то не добавляем ее
            if(!empty($value['name'])) {

                $category = $categories->where('name', $value['name']);

                // проверяем что такой категории действительно нет
                if (!$category->exists()) {

                    //доп. поля необходимые для добавлеия категории
                    $value['direction_id'] = 1;
                    $value['parent_id'] = 0;
                    $value['slug'] = Str::slug($value['name']);
                    $value['status'] = 1;
                    $value['created_at'] = now();
                    $value['updated_at'] = now();

                    $new_categories_id[] = DB::table('categories')->insertGetId($value);
                } else {
                    // иначе просто добавляем ее
                    $new_categories_id[] = $category->value('id');
                }
            }
        }


        // добавляем новые id добавленных категорий
        $this->sCategories = array_merge($this->sCategories, $new_categories_id);

        // валидируем на всякий случай данные чтобы не было больше 3ex категорий

        // добавляем фильтры продукта
        if(count($this->sCategories) > 0)  {
            // удаляем категории продукта если они есть
            $product_to_cateory->where('product_id', $this->product_id)
                ->delete();
            // добавляем новые фильтры
            foreach($this->sCategories as $category_id) {
                $product_to_cateory->insert([
                    'product_id' => $this->product_id,
                    'category_id' => $category_id
                ]);
            }
        }
        return true;
    }

    /**
     * создать новый продукт
     * @return int
     */
    private function newProduct() {

        $product = new Product();
        $product->name = $this->name;
        $product->slug = Str::slug($this->name, '-');
        $product->description = $this->description;
        $product->short_description = Str::limit($this->name, 20);
        $product->price = $this->price;
        $product->quantity = $this->quantity ?? 1000; // по умолчанию 1000
        $product->image = null;
        $product->direction_id = $this->getPartnerByUserRole()->direction_id;
        $product->stock_status = 'instock';
        $product->status = 1;
        $product->partner_id = $this->getPartnerByStore();
        $product->moderated = $this->user_role ? '1' : '0';
        $product->save();

        return $product->id;
    }

    /**
     * получает партнера в зависимости от роли пользователя
     * @return mixed
     */
    private function getPartnerByUserRole() {
        // $partner_id = $this->user_role ?
        //     Store::find(Store::store_id())->partner_id :
        //     Auth::user()->partner_id;
        $partner_id = Auth::user()->partner_id;

        return Partners::find($partner_id);
    }

    /**
     * получает партнера в зависимости от города (store)
     * @return mixed
     */
    private function getPartnerByStore() {
//        dd(Partners::where('store_id', Store::store_id())->where('status', 1));

		return Auth::user()->partner_id;

        // return $this->user_role ?
        //     Partners::where('store_id', Store::store_id())->where('status', 1)->first()->id :
        //     Auth::user()->partner_id;
    }

    /**
     * Получить markup цены либо старую цену
     * @param $price
     * @param bool $needOldPrice
     * @return false|float
     */
    private function getMarkupPrice(int $price, bool $needOldPrice = false) {

              // защита от дурака, чтобы не указали случайно цену меньше 0 или 0
              if($price > 0) {

                  // 1. получаем наценку и % скидки
                  $markup = $this->markup ?? 15.00; // по умолчанию 15%
                  // если не указана скидка, то ноль (сказала Ксения)
                  $discount = (int) $this->discount > 0 ? $this->discount : 0;

                  // 3. высчитываем размер наценки и скидки
                  $markupValue = ceil($price * ($markup * 0.01));
                  // при умножении на 0 всегда 0 (математика)
                  $discountValue = ceil($price * ($discount * 0.01));

                  // если нужна наценка партнера, то возвращаем ее иначе старую цену
                  return $needOldPrice ? $price + $discountValue : $price - $markupValue;

              }

    }

    /**
     * позволяет удалить временный файл
     * @param $tmp_name
     * @return void
     */
    public function deleteTmpFile($tmp_name) {
        // 1. удаляем из массива tmp изображениe
        foreach($this->images as $key=> $image) {
            if($image->getFilename() == $tmp_name) {
                unset($this->images[$key]);
            }
        }
        // 2. удаляем из папки tmp изображение
//        foreach(Storage::files('livewire-tmp') as $tmp_file) {
//            if(basename($tmp_file) == $tmp_name)  {
//                Storage::delete($tmp_file);
//            }
//        }
    }

    /*
     * редактировать конкртеный tmp файл
     */
    public function editTmpFile() {
        if(!empty($this->edit_images)) {
            foreach($this->edit_images as $key => $tmp_upload) {
                $this->images[$key] = $tmp_upload['edit_image'];
            }
        }
    }

    /**
     * вывод  шаблона на страницу
     * @return void
     */
    public function render() {

        // перед выводом удаляем пустые фильтры
        $filters = Filters::active()
            ->hasPartner()->orderBy('name', 'ASC')
            ->get()->reject(function($category) {
                return empty($category->name);
            })->reject(function($category) {
                return empty($category->name);
            });;

        // перед выводом удаляем пустые категории
        $categories = Category::active()
            ->hasPartner()->where('partner_id', Auth::user()->partner_id)->orderBy('name', 'ASC')
            ->get()->reject(function($category) {
                return empty($category->name);
            });

//        dd($categories);

        return view('livewire.admin.product.admin-add-product-component',
            [
                'filters' => $filters,
                'categories'=> $categories,
            ])->layout('layouts.base');
    }

}
