<?php

namespace App\Http\Livewire\Admin;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{

    // трейт необходим для загрузки изображений
    use WithFileUploads;

    public int $product_id;
    public array $images = []; // изображения
    public array $deleted_images = [];
    public array $additional_images = []; // добавить изображения


    // для блока редактировать описание
    const EDIT_DESCRIPTION = [
        // фильтры
        'filters' => 'products_to_filters',
        'categories' => 'product_to_categories',
        'name' => 'products',
        'description' => 'products',
        'compounds' => 'products_to_compound', // не отключается
        'parameters' => 'products_to_parameters', // не отключается
        'specifications' => 'products_to_specifications', // не отключается
        'materials' => 'products_to_materials',
        'additional_info' => 'products_to_info',
        'more_additional_info' => 'products_to_additional_info',
        'another_option' => 'products_to_another_opt',
        'price' => 'products',
        'partner_price' => 'product_to_stores',
        'discount' => 'product_to_stores',
        'store_old_price' => 'product_to_stores',
        'markup' => 'partners',
    ];


    public array $filters = [];
    public array $categories = [];
    public array $add_categories = [];
    public $name, $description;
    public array $compounds = [];
    public array $parameters = [];
    public array $specifications = [];
    public array $materials = [];
    public array $additional_info = [];
    public array $additional_videos = []; // видео продукта
    public array $more_additional_info = [];
    public array $another_option = [];
	public array $options = [];
    // цена/партнерская цена/старая цена/нацена/скидка (для старой цены)
    public $price, $partner_price, $discount, $store_old_price, $markup;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'max:1000',
            'price' => 'required',
            'discount' => 'required|lt:100',
            'compounds.*.value' => 'required|max:20',
            'compounds.*.number' => 'not_in:0',
            'specifications.*.value' => 'required|max:30',
            'materials.*.value' => 'required|max:30',
            'additional_videos.*.value' => 'required|url',
			'options' => ['array', 'nullable'],
			'options.*.name' => ['required', 'string', 'max:50'],
			'options.*.value' => ['required', 'string', 'max:150'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать название товара',
            'name.max' => 'Максимальная длина названия товара 100 символов',
            'price.required' => 'Необходимо указать цену товара',
            'description.max' => 'Максимальная длина описания товара 1000 символов',
            'discount.required' => 'Укажите скидку для старой цены (если ее нет, то укажите 0)',
            'discount.lt' => 'Cкидка не может быть больше 100%',
            'compounds.*.value.required' => 'Необходимо указать название состава',
            'compounds.*.value.max' => 'Название состава не может быть больше 20 символов',
            'compounds.*.number.not_in' => 'Количество состава не может быть равно нулю',
            'specifications.*.value.required' => 'Необходимо указать тех.характеристику товара',
            'specifications.*.value.max' => 'Тех.характеристика не может быть больше 30 символов',
            'materials.*.value.required' => 'Необходимо указать материал товара',
            'materials.*.value.max' => 'Материал не может быть больше 30 символов',
            'additional_videos.*.value.required' => 'Необходимо указать ссылку на видео',
            'additional_videos.*.value.url' => 'Введенное значение должно быть ссылкой',
			'options.*.name.required' => 'Нужно заполнить имя характеристики.',
			'options.*.value.required' => 'Нужно заполнить значение характеристики.',
        ];
    }

    public function mount($product_id) {

        $product = Product::find($product_id);
        if ($product) {
            $this->price = $product->store_price;
        }
        // получает все изображения товара
        $this->product_id = $product_id;
        $this->getImages($this->product_id);
        // генерируется блоки описания товара
        $this->renderDescBlocks($product_id);
		$this->options = $product->options ?? [];
    }

    /*
     * получает все загруженные изображения товара
     * первый элемент - обложка и id продукта
     * array:3 [▼
          0 => array:2 [▼
            "product_id" => 2339
            "url" => "storage/products/June2022/1654502922.jpg"
          ]
          1 => array:2 [▼
            "media_id" => 71
            "url" => "storage/products/June2022/1654502922_800px.jpg"
          ]
          2 => array:2 [▼
            "media_id" => 72
            "url" => "storage/products/June2022/1654502922_800px.jpg"
          ]
        ]
     */
    private function deleteImageFiles($delete_imgs) {
        if($delete_imgs) {

            foreach ($delete_imgs as $file) {

                    DB::table('media')
                        ->where('id', $file['media_id'])
                        ->delete();
                    DB::table('products')
                        ->where('id', $this->product_id)->update([
                            'image' => null
                        ]);
                    $storage_path = explode('storage/', $file['url_300'])[1];
                    if (Storage::exists($storage_path)) {
                        Storage::delete($storage_path);
                    }
                    $storage_path = explode('storage/', $file['url_800'])[1];
                    if (Storage::exists($storage_path)) {
                        Storage::delete($storage_path);
                    }
                }
            $this->deleted_images = [];
            }

    }
    private function getImages($product_id)
    {

        $product_media = DB::table('products as p')
            ->select('p.id as product_id', 'm.id as media_id', 'p.image','m.image_path' ,'m.resize_image_path')
            ->leftJoin('media as m', 'p.id', '=', 'm.product_id')
            ->where('p.id', $product_id)->get()->toArray();

            foreach ($product_media as $key => $media) {
                if($media->media_id) {
                $this->images[] = [
                    'media_id' => $media->media_id,
                    'url' => route('home') . '/storage/' . $media->resize_image_path,
                    'url_300' => route('home') . '/storage/' . $media->resize_image_path,
                    'url_800' => route('home') . '/storage/' . $media->image_path,
                    'status' => 'based'
                ];
            }
        }
    }

	public function addOption()
	{
		$this->options[] = ['name' => '', 'value' => ''];
	}

	public function deleteOption(int $key)
	{
		unset($this->options[$key]);
	}

    // создает блоки описания товара
    private function renderDescBlocks($product_id) {
        foreach(self::EDIT_DESCRIPTION as $field => $table) {
            // обязательно должно существовать св-во для записи
            if(property_exists($this, $field) && !empty($table)) {
                switch($table) {
                    /* БЛОК ФИЛЬТРОВ/КАТЕГОРИЙ */
                    case 'products_to_filters':
                    case 'product_to_categories':

                        $attr_id = 'filter_id';
                        $model = Filters::active();

                        if($table == 'product_to_categories') {
                            $attr_id = 'category_id';
                            $model = Category::active();
                        }

                        // 1. получаем все фильтры/категории
                        $data = $model->hasPartner()->orderBy('name', 'ASC')->get();
                        // 2. получаем фильтры/категории со статусом checked
                        $checked_data = DB::table($table)
                            ->select($attr_id)
                            ->where('product_id', $product_id)
                            ->get()->map(function($check_select) use ($attr_id) {
                                return $check_select->{$attr_id};
                            })->toArray();
                        // 3. формируем подходящий массив для вывода
                        foreach($data as $select) {
                            // не добавляем пустые фильтры/категории если они есть
                            if(empty($select->name)) continue;

                            $this->{$field}[] = [
                                $attr_id => $select->id,
                                'checked' => in_array($select->id, $checked_data),
                                'modified' => false,
                                'value' => $select->name
                            ];
                        }
                    break;
                    /* НАЗВАНИЕ/ОПИСАНИЕ продукта */
                    case 'products':
                         $this->{$field} = DB::table($table)
                             ->where('id', $product_id)->value($field);
                    break;
                    /* СОСТАВ продукта */
                    case 'products_to_compound':
                        $compounds = DB::table($table)
                            ->where('product_id', $product_id)->get();
                        foreach($compounds as $cmp) {
                            $this->{$field}[] = [
                                'compound_id' => $cmp->id,
                                'modified' => false,
                                'value' => $cmp->compound,
                                'number' => $cmp->number
                            ];
                        }
                    break;
                    /* ПАРАМЕТРЫ продукта */
                    case 'products_to_parameters':
                         // если пустая - значит старый товар, придется создать в таблице
                         if(!DB::table($table)
                             ->where('product_id', $product_id)->exists()) {
                             DB::table($table)->insert([
                                 'product_id' => $this->product_id,
                                 'created_at' => now(),
                                 'updated_at' => now(),
                             ]);
                         }
                        $this->parameters = (array) DB::table($table)
                            ->where('product_id', $product_id)->first();
                    break;
                    /* СПЕЦИФИКАЦИИ продукта */
                    case 'products_to_specifications':
                        $specifications = DB::table($table)
                            ->where('product_id', $product_id)->get();
                        foreach($specifications as $spc) {
                            /// не добавляем пустые значения
                            if(empty($spc->specification)) continue;

                            $this->{$field}[] = [
                                'specification_id' => $spc->id,
                                'modified' => false,
                                'value' => $spc->specification,
                            ];
                        }
                    break;
                    /* МАТЕРИАЛЫ продукта */
                    case 'products_to_materials':
                        $materials = DB::table($table)
                            ->where('product_id', $product_id)->get();
                        foreach($materials as $mtr) {
                            /// не добавляем пустые значения
                            if(empty($mtr->material)) continue;

                            $this->{$field}[] = [
                                'material_id' => $mtr->id,
                                'modified' => false,
                                'value' => $mtr->material,
                            ];
                        }
                    break;
                    // 7. ДОП. ИНФОРМАЦИЯ товара
                    case 'products_to_info':
                        $this->additional_info = (array) DB::table('products_to_info')
                            ->where('product_id', $this->product_id)
                            ->first();
                        // получаем ccылки на видео
                        if(!empty($this->additional_info)) {
                            // если попались пустые ссылки то не добавляем их
                            if(!is_null($this->additional_info['video_links']) && !empty($this->additional_info['video_links']['value'])) {
                                // декодируем ccылки на видео (убираем не уникальные)
                                $video_links = array_unique(json_decode($this->additional_info['video_links'], true));
                                // приводим массив к необходимому виду
                                foreach($video_links as $link) {
                                    $this->additional_videos[] = [
                                        'value' => $link
                                    ];
                                }
                                // Удаляем из массива доп. видео
                                unset($this->additional_info['video_links']);
                            }
                        }
                    break;

                    // 8. ЕЩЕ БОЛЬШЕ ДОП ИНФОРМАЦИИ товара
                    case 'products_to_additional_info':
                        $more_addition = DB::table($table)
                            ->where('product_id', $product_id)->get();
                        foreach($more_addition as $m_add) {
                            /// не добавляем пустые значения
                            if(empty($m_add->additional_info)) continue;

                            $this->{$field}[] = [
                                'addition_id' => $m_add->id,
                                'value' => $m_add->additional_info,
                            ];
                        }
                    break;

                    // 9. получаем партнерскую/старую цену/markup
                    case 'product_to_stores':
                        $this->{$field} = DB::table($table)
                            ->where('product_id', $this->product_id)
                            ->value($field);

                        if($field == 'markup' && is_null($this->{$field})) {
                            $this->{$field} = 15.00; // по умолчанию 15%
                        }
                    break;
                    case 'partners':
                        $markup = DB::table('product_to_stores as ps')
                            ->leftJoin('partners as p', 'ps.partner_id', '=', 'p.id')
                            ->where('ps.product_id', '=', $this->product_id)
                            ->value('markup');
                        $this->markup = !is_null($markup) ? $markup : 15.00;
                    break;
                    case 'products_to_another_opt':
                        // если пустая - значит старый товар, придется создать в таблице
                        if(!DB::table($table)
                            ->where('product_id', $product_id)->exists()) {
                            DB::table($table)->insert([
                                'product_id' => $this->product_id,
                                'fragile' => 'fragile',
                                'transportation' => 'danger',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }

                        $this->another_option = (array) DB::table($table)
                            ->select('id as another_option_id', 'transportation', 'fragile')
                            ->where('product_id', $this->product_id)
                            ->first();
                }
            }
        }
    }



    /*
     * удалить изображения
     */
    public function deleteImage($key) {

        // для удаления изображения ставим null
        if(isset($this->images[$key]['media_id']) && is_string($this->images[$key]['url'])) {
            $this->deleted_images[] = $this->images[$key];
        }
        $this->images[$key]['url'] = '';



        // если пользователь удалил обложку
//        if(isset($this->images[$key]['product_id']) && count($this->images) != 1) {
//            for($i = $key + 1; $key < count($this->images); $i++) {
//                // находим ближайшей media файл со ссылкой
//                if(isset($this->images[$i]['url'])) {
//
//                    // перемещаем его ссылку в cover обложку
//                    $this->images[$key]['url'] = $this->images[$i]['url'];
//
//                    $this->images[$i]['url'] = '';
//
//                    break;
//                }
//            }
//        }

        return true;
    }

    /*
     * добавить новую категорию
     */
    public function addCategory() {
        $this->add_categories[] = [
            'category_id' => '',
            'checked' => true, // по умолчанию, новая добавленная категория отмечена
            'modified' => true,
            'value' => ''
        ];
    }

    /*
    * добавить новый компонент
    */
    public function addCompound() {
        $this->compounds[] = [
            'compound_id' => '',
            'modified' => true,
            'value' => '',
            'number' => 0
        ];
    }

	public function deleteCompound(int $key)
	{
		unset($this->compounds[$key]);
	}

    /*
    * добавить новую спецификацию
    */
    public function addSpecification() {
        $this->specifications[] = [
            'specification_id' => '',
            'modified' => true,
            'value' => '',
        ];
    }

    /*
     * добавить новый материал
     */
    public function addMaterial() {
        $this->materials[] = [
            'material_id' => '',
            'modified' => true,
            'value' => '',
        ];
    }

    /*
     * добавить видео
     */
    public function addVideoLink() {
        $this->additional_videos[] = [
            'value' => ''
        ];
    }

    /*
    * добавить больше информации о товаре
    */
    public function addMoreInfo() {
        $this->more_additional_info[] = [
            'addition_id' => '',
            'value' => ''
        ];
    }


    /*
    * увеличивает/уменьшает значение компонента
    */
    public function changeCmpNum($cmp_key, $direction) {
        if($direction == 'inc') {
            $this->compounds[$cmp_key]['number']++;
            $this->compounds[$cmp_key]['modified'] = true;
        } else {
            if($this->compounds[$cmp_key]['number'] != 0) {
                $this->compounds[$cmp_key]['number']--;
                $this->compounds[$cmp_key]['modified'] = true;
            } else {
                $this->compounds[$cmp_key]['number'] = 0;
            }
        }
    }

    /*
     * добавление новых изображений
     */
    private function addImages() {

        if(!empty($this->additional_images)) foreach($this->additional_images as $add_key => $add_image) {

            // флаг проверки было ли обновлено изображение
            $edit_img = false;
            $product_or_media_key = $add_key == 0 ? 'product_id' : 'media_id';

            if(!empty($this->images)) foreach($this->images as $img_key => $img_array) {
                // пропускаем если url уже указан
                if(!empty($img_array['url'])) continue;
                // иначе добавляем
                $this->images[$img_key]['url'] = $add_image;
                // пишем что изображение было обновлено
                $edit_img = true;
                // после добавления, останавливаем цикл
                break;
            }

            // если изображение не было обновлено,
            // то в конец массива его
            if(!$edit_img) {
               $this->images[] = [
                   $product_or_media_key => '',
                   'url' => $add_image
               ];
            }

        }

        $this->reset('additional_images');
    }

    /*
     * добавляет окно загрузки изображений, если все url пустые
     */
    private function needUploader() :bool {
        $need_uploader = true;
        foreach($this->images as $img) {
            if(!empty($img['url'])) {
                $need_uploader = false;
                break;
            }
        }
        return $need_uploader;
    }

    /*
     * изменяет real-time цену партнера
     */
     public function changePartnerPrice() {

        // вадилируем, чтобы случайно не передалась строка
        $this->validate();
        // на всякий случай чтобы не указали отрицательную цену
        if($this->price > 0) {
            // измененная партнерская цена
            $this->partner_price = ceil((int) $this->price - ((int) $this->price * ($this->markup * 0.01)));
        }

        // для старой цены
        if($this->discount > 0) {
            $this->store_old_price = ceil($this->price + ($this->price * ($this->discount * 0.01)));
        }

     }

    /*
     * обновляет в базе данных по массиву изображения товара
     * основной метод
     */
    public function updateImages() {

        // real-time валидация (ВСЕ ПОЛЯ!)
        $this->validate();

        if($this->deleted_images) {
            $this->deleteImageFiles($this->deleted_images);
        }
        // папка сохранения изображений
        $folder_with_month = Carbon::now()->format('FY');
        if($this->images) {
            foreach($this->images as $key =>$image) {
                if($image['url'] && is_object($image['url'])) {

                    $timestamp = Carbon::now()->timestamp;
                    $image_path_800 = $this->resizeImg($image, 800, $folder_with_month, $timestamp);
                    $image_path_300 = $this->resizeImg($image, 300, $folder_with_month, $timestamp);

                    if(isset($image['status']) && $image['status'] == 'updated') {

                        DB::table('media')
                            ->where('id', $image['media_id'])
                            ->update([
                            'image_path' => $image_path_800,
                            'resize_image_path' => $image_path_300,
                            'product_id' => $this->product_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        DB::table('media')->insert([
                            'image_path' => $image_path_800,
                            'resize_image_path' => $image_path_300,
                            'product_id' => $this->product_id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
            // add main image
            $main_img_path = DB::table('media')->select('resize_image_path')->where('product_id', $this->product_id)->first();
            if($main_img_path && $main_img_path->resize_image_path) {
                DB::table('products')
                    ->where('id', $this->product_id)->update([
                        'image' => $main_img_path->resize_image_path
                    ]);
            }

        }
//        foreach($this->images as $image) {
//
//                // timestamp единый для всех изображений
//                $timestamp = Carbon::now()->timestamp;
//                $old_cover_img = DB::table('products')
//                    ->where('id', $this->product_id)
//                    ->value('image');
//
//                // 1.если это обложка изображения и в ней обновилось изображение (либо добавилось новое)
//                if(isset($image['product_id']) && !empty($image['product_id']) && !is_string($image['url'])) {
//
//                    $this->updateImage($image, 'products', $folder_with_month, $timestamp);
//
//                // 2. если была удалена старая обложка и она не соответствует новой
//                } else if(isset($image['product_id']) && !empty($image['product_id']) && isset($image['url'][1]) && $old_cover_img != explode('/storage/', $image['url'])[1]) {
//
//                    $this->updateImage($image, 'products');
//
//                // 2. если это дополнительное изображение продукта
//                } else if(isset($image['media_id']) && !empty($image['media_id']) && !is_string($image['url'])) {
//
//                    $this->updateImage($image, 'media', $folder_with_month, $timestamp);
//
//                // 3. добавление новых доп. фотографий (гл. добавляется в первом if)
//                } else if(isset($image['media_id']) && empty($image['product_id']) && !is_string($image['url'])) {
//
//                    // загружаем resize изображений
//                    $image_path_800 = $this->resizeImg($image, 800, $folder_with_month, $timestamp);
//                    $image_path_300 = $this->resizeImg($image, 300, $folder_with_month, $timestamp);
//
//                    // добавляем их БД
//                    DB::table('media')->insert([
//                        'image_path' => $image_path_800,
//                        'resize_image_path' => $image_path_300,
//                        'product_id' => $this->product_id,
//                        'created_at' => now(),
//                        'updated_at' => now(),
//                    ]);
//                // 4. удаление изображений
//                } else if(empty($image['url'])) {
//                    // если удалена обложка
//                    if(isset($image['product_id'])) {
//                        DB::table('products')
//                            ->where('id', $image['product_id'])->update([
//                                'image' => null
//                            ]);
//                    // иначе доп. изображения
//                    } else if(isset($image['media_id'])) {
//                        DB::table('media')
//                            ->where('id', $image['media_id'])
//                            ->delete();
//                    }
//
//                }
//
//        }


        // сообщение об обновлении описания
        session()->flash('update_image', 'Изображения товара успешно обновлены!');
    }

    /*
    * обновляет в базе данных по массиву описание товара
    * основной метод
    */
    public function updated($propertyName)
    {

        $attr = explode('.', $propertyName);
        $updated_array = ['filters', 'categories', 'specifications', 'materials'];

        // real-time валидация (ВСЕ ПОЛЯ!)
        $this->validate();
        // update imagae
        if(isset($attr[0]) && $attr[0] == 'images' && isset($attr[1])) {
            $this->updateImage($attr[1]);
        }
        // для фильтров
        if(in_array($attr[0], $updated_array)) {
            $position = $attr[1];
            // указываем, что данный чекбокс был изменен
            $this->{$attr[0]}[$position]['modified'] = true;
            // не более трех фильтров/категорий
            if($attr[0] == 'filters' || $attr[0] == 'categories') {
                $check_counter = 0;
                foreach($this->{$attr[0]} as $select) {
                    if($select['checked']) $check_counter++;
                }
                if($check_counter > 3) {
                    $name = $attr[0] == 'filters' ? 'фильтров' : 'категорий';
                    $this->addError('max_checked_'.$attr[0], 'Можно выбрать не больше 3ex '.$name);
                }
            }
        }

    }

    private function updateImage($key) {
       if($this->images && is_object($this->images[$key]['url']) && isset($this->images[$key]['url_300'])) {
           $this->images[$key]['status'] = 'updated';
       }
    }

    /*
     * делает ресайз изображений
     */
    private function resizeImg($image, $resize_px, $folder_with_month, $timestamp) {

        if($image['url']) {
			$preview_folder = $resize_px == 300 ? 'preview/' : '';
			$imgName = $timestamp . "_".$resize_px."px." . $image['url']->extension();
			$path = public_path('storage/products/'.$folder_with_month . "/$preview_folder");
			$image_path = public_path('storage/products/'.$folder_with_month . "/$preview_folder" . $imgName);

			if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

			Image::make($image['url']->temporaryUrl())->resize($resize_px, $resize_px)->save($image_path);

			if($preview_folder) return 'products/'. $folder_with_month .'/preview/'. $imgName;
			else return 'products/'. $folder_with_month .'/'. $imgName;
        }
        return false;
    }

    public function updateDescription() {

        // real-time валидация (ВСЕ ПОЛЯ!)
        $this->validate();

        // 1. ФИЛЬТРЫ/КАТЕГОРИИ
        // если есть добавленные категории, записываем их в таблицу категорий
        if($this->add_categories) {
            foreach($this->add_categories as $key => $category) {

                // категории с пустыми значениями не добавляем
                if(empty($category['value'])) continue;
                // указываем id новой категории
                $this->add_categories[$key]['category_id'] = DB::table('categories')->insertGetId([
                    'direction_id' => 1,
                    'parent_id' => 0,
                    'slug' => Str::slug($category['value']),
                    'name' => $category['value'],
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // добавляем в основной массив
            $this->categories = array_merge($this->categories, $this->add_categories);
            $this->reset('add_categories'); // после слияния, сбрасываем массив
        }

        foreach(['categories', 'filters'] as $select_data) {
            foreach($this->{$select_data} as $data) {

                $attr_id = 'filter_id';
                $table = 'products_to_filters';
                if($select_data == 'categories') {
                    $attr_id = 'category_id';
                    $table = 'product_to_categories';
                }

                // интересуют только измененные чекбоксы
                if(!$data['modified']) continue;
                // если добавлен фильтр
                if($data['checked']) {
                    DB::table($table)
                        ->insert([
                            'product_id' => $this->product_id,
                            $attr_id => $data[$attr_id],
                        ]);
                } else {
                    DB::table($table)
                        ->where($attr_id, $data[$attr_id])
                        ->delete();
                }
            }
        }

        // 2. НАЗВАНИЕ/ОПИСАНИЕ товара
        foreach(['name', 'description'] as $attr) {
            if(!DB::table('products')
                ->where('id', $this->product_id)
                ->where($attr, $this->{$attr})
                ->exists()) {
                DB::table('products')
                    ->where('id', $this->product_id)
                    ->update([$attr => $this->{$attr}]);
            }
        }

        // 3. СОСТАВ товара
		$existingCompoundsIds = DB::table('products_to_compound')
			->where('product_id', $this->product_id)
			->get()->pluck('id');

        foreach($this->compounds as $compound) {

            if(!empty($compound['compound_id'])) {
				$existingCompoundsIds = $existingCompoundsIds->reject(function ($item) use ($compound) {
					return $item == $compound['compound_id'];
				});

				if(!$compound['modified']) continue;

                DB::table('products_to_compound')
                    ->where('id', $compound['compound_id'])
                    ->update([
                        'compound' => $compound['value'],
                        'number' => $compound['number']
                    ]);
            // заполняем только если не пустое значение компонента и его число
            } else if(!empty($compound['value']) && $compound['number'] != 0) {
                DB::table('products_to_compound')
                    ->insert([
						'product_id' => $this->product_id,
						'compound' => $compound['value'],
						'number' => $compound['number']
                    ]);
            }
        }

		if ($existingCompoundsIds->isNotEmpty()) {
			DB::table('products_to_compound')
				->whereIn('id', $existingCompoundsIds)
				->delete();
		}

        // 4. ПАРАМЕТРЫ товара
        if(DB::table('products_to_parameters')
            ->where('product_id', $this->product_id)->exists()) {
            DB::table('products_to_parameters')
                ->where('product_id', $this->product_id)
                ->update($this->parameters);
        } else {
            DB::table('products_to_parameters')
                ->where('product_id', $this->product_id)
                // при добавлении нужен product_id
                ->insert(array_merge(
                    ['product_id' => $this->product_id],
                    $this->parameters));
        }
        // 5. ТЕХ. ХАРАКТЕРИСТИКИ товара
        foreach($this->specifications as $specification) {
            // Только обновленные тех. характеристики
            if(!$specification['modified']) continue;
            // обновляем если есть id и value
            if(!empty($specification['value'])) {
                if(!empty($specification['specification_id'])) {
                    DB::table('products_to_specifications')
                        ->where('id', $specification['specification_id'])
                        ->update(['specification' => $specification['value']]);
                } else {
                    DB::table('products_to_specifications')
                        ->where('id', $specification['specification_id'])
                        ->insert([
                            'product_id' => $this->product_id,
                            'specification' => $specification['value'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                }
            }
        }
        // 6. МАТЕРИАЛЫ товара
        foreach($this->materials as $material) {
            // только обновленные материалы
            if(!$material['modified']) continue;

            if(!empty($material['value'])) {
                if(!empty($material['material_id'])) {
                    DB::table('products_to_materials')
                        ->where('id', $material['material_id'])
                        ->update(['material' => $material['value']]);
                } else {
                    DB::table('products_to_materials')
                        ->where('id', $material['material_id'])
                        ->insert([
                            'product_id' => $this->product_id,
                            'material' => $material['value'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                }
            }
        }
        // 7. ДОП. ИНФОРМАЦИЯ товара

        // добавляем ссылки на видео, если они есть
        if(!empty($this->additional_videos)) {

            $preperate = [];

            foreach($this->additional_videos as $key => $video) {
                // если видео не было указано, то удаляем пустое значение
                if(empty($video['value'])) unset($this->additional_videos[$key]);
                $preperate[] = $video['value'];
            }
            // удаляем не уникальные (дублирующиеся) видео
            $additional_videos = array_unique($preperate);
            // сохраняем как json массив в базу
            $this->additional_info['video_links'] = json_encode($additional_videos);
        }

        if(DB::table('products_to_info')
            ->where('product_id', $this->product_id)->exists()) {
            DB::table('products_to_info')
                ->where('product_id', $this->product_id)
                ->update($this->additional_info);
        } else {
            DB::table('products_to_info')
                ->where('product_id', $this->product_id)
                // при добавлении нужен product_id
                ->insert(array_merge(
                    ['product_id' => $this->product_id],
                    $this->additional_info));
        }

        // 8. Еще доп. информации
        if(!empty($this->more_additional_info)) {
            foreach($this->more_additional_info as $more_info) {
                // не добавляем пустые значения
                if(empty($more_info['value'])) continue;

                // если пустой id, значит добавляем
                if(empty($more_info['addition_id'])) {
                    DB::table('products_to_additional_info')
                        ->where('product_id', $this->product_id)
                        // при добавлении нужен product_id
                        ->insert([
                            'product_id' => $this->product_id,
                            'additional_info' => $more_info['value'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    // иначе обновляем
                } else {
                    DB::table('products_to_additional_info')
                        ->where('id', $more_info['addition_id'])
                        ->update([
                            'additional_info' => $more_info['value']
                        ]);
                }

            }
        }
        // 9. ДРУГИЕ ОПЦИИ
        if(!empty($this->another_option)) {
            if(DB::table('products_to_another_opt')
                ->where('id', $this->another_option['another_option_id'])
                ->exists()) {
                DB::table('products_to_another_opt')
                    ->where('id', $this->another_option['another_option_id'])
                    ->update([
                        'fragile' => $this->another_option['fragile'],
                        'transportation' => $this->another_option['transportation']
                    ]);
            } else {
                DB::table('products_to_another_opt')
                    ->insert([
                        'product_id' => $this->product_id,
                        'fragile' => $this->another_option['fragile'],
                        'transportation' => $this->another_option['transportation'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
            }
        }

		Product::where('id', $this->product_id)->update([
			'options' => $this->options,
		]);

        // сообщение об обновлении описания
        session()->flash('update_description', 'Товар успешно обновлен!');
    }

    /*
     * обновить цену
     */
    public function updatePrice() {

        // real-time валидация (ВСЕ ПОЛЯ!)
        $this->validate();

        DB::table('product_to_stores')
            ->where('product_id', $this->product_id)
            ->update([
                'partner_price' => $this->partner_price,
                'store_price' => $this->price,
                'discount' => $this->discount,
                'store_old_price' => $this->discount > 0 ? $this->store_old_price: 0,
            ]);
        DB::table('products')
            ->where('id', $this->product_id)
            ->update([
                'price' => $this->price,
            ]);

        session()->flash('message', 'Товар успешно обновлен!');
        $this->redirect(route('admin.products'));
    }


    /**
     * вывод  шаблона на страницу
     * @return void
     */
    public function render() {

        // перед отображением изображений
        // проверяет наличие ново добавленных
        $this->addImages();

		$partnerCategories = Category::where('partner_id', Auth::user()->partner_id)
			->get(['id'])
			->pluck('id')
			->toArray()
		;

		$result = array_filter($this->categories, function ($category) use ($partnerCategories) {
			return in_array($category['category_id'], $partnerCategories);
		});

		$this->categories = $result;

        return view('livewire.admin.product.admin-edit-product-component', [
            'need_uploader' => $this->needUploader()
        ])->layout('layouts.base');
    }

}
