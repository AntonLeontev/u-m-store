<?php

namespace App\Http\Livewire\Exel;

use App\Models\Options\ProductOption;
use App\Models\Options\ProductOptionValue;
use App\Models\Product_to_store;
use App\Models\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use SimpleXLSX;


class PriceImportComponent extends Component
{

    use WithFileUploads;
    protected $messages = [
        'exel_file.required' => 'Вы не выбрали файл для загрузки!',
        'exel_file.max' => 'Привышенно максиально допустимый размер файла :attribute в :max кбайт!',
    ];

    public $store_id;
    public $partner_id;
    public $product_id;

    public $exel_file;
    public $original_file_name;
    public $exel_file_path;
    public $real_name;


    public function updated($file){
        $this->validateOnly($file, [
            'exel_file' => 'required|max:4096', // 4MB Max
        ]);
    }
    public function save()
    {
        $this->original_file_name = Str::lower($this->exel_file->getClientOriginalName());
        $this->real_name = Str::lower(Store::find($this->store_id)->real_name);
        if (!is_null($this->exel_file) && Str::contains($this->original_file_name,$this->real_name)) {
            $this->exel_file->storeAs('exel_price_downloads', 'reviews.xlsx');
//            dd($this->exel_file);
            session()->flash('file_load', 'Файл успешно загружен!');
        } elseif (!Str::contains($this->original_file_name,$this->real_name)){
            session()->flash('file_not_load', 'Файл не загружен! В имени файла "'.$this->original_file_name.'" нет выбраного города!');
        }
    }

    public function loadExelIntoDatabase()
    {
        /**
         * Функция загружает данные из exel файла в базу данных.
         * Формат файла должен быть xlsx
         */
        if ($this->store_id == 0) {
            session()->flash('no_store', 'Вы не выбрали город. Загрузка в базу остановлена!');
        } else {
            if ((Storage::disk('local')->exists('/exel_price_downloads/reviews.xlsx'))) {
                //Получаем полный путь к файлу.
                $exel_file = Storage::path('exel_price_downloads/reviews.xlsx');
                $this->exel_file_path = $exel_file;
                //Делаем заголовки столбцов ключами дли доступа к элементам массива
                if ($xlsx = SimpleXLSX::parse($exel_file)) {

                    //Переводим все значения дата в unix time
                    $xlsx->setDateTimeFormat('U');
                    // Производим ключи массива из значений массива 1-го элемента массива
                    $header_values = $rows = [];
                    foreach ($xlsx->rows() as $k => $r) {
                        if ($k === 0) {

                            $header_values = $r;

                            if ($r[0] == 'ID для сайта' && $r[2] == 'НАЗВАНИЕ' && $r[3] == 'РАЗМЕР' && $r[4] == 'Базовая цена Кения') {

                                continue;
                            } else {

                                session()->flash('file_to_database_error', 'Файл не загружен ! Неверный формат файла. Заголовки столбцов должны содержать "ID для сайта" ,"НАЗВАНИЕ" ,"РАЗМЕР", "Базовая цена Кения" и т.д.');
                                return;
                            }

                        }
                        $rows[] = array_combine($header_values, $r);
                    }

                }


                foreach ($rows as $row) {
                    //Промежуточный массив для загрузки в базу
                    $push_data = [];
                    $r = 0;//счетчик массива

                    //Выбираем option_value_id по значению в ячейке.
                    switch ((int)$row['РАЗМЕР']) {
                        case 40:
                            $kenia_id = 63;
                            $ekvador_id = 67;
                            $baze_id = 23;
                            break;
                        case 50:
                            $kenia_id = 64;
                            $ekvador_id = 68;
                            $baze_id = 24;
                            break;
                        case 60:
                            $kenia_id = 65;
                            $ekvador_id = 69;
                            $baze_id = 44;
                            break;
                        case 70:
                            $kenia_id = 66;
                            $ekvador_id = 70;
                            $baze_id = 45;
                            break;
                        case '':
                            $baze_id = 0;
                    }


                    //Если id меняется, то записываем или обновляем в таблице product_to_store цену наименьшую
                    // цену опций.
                    if ($this->product_id != null && $this->product_id != $row['ID для сайта']) {
                        $min_partner_price = $this->ProductOptionValueMinPrice();
                        //Ecли цена не null значит записываем ее в таблицу product_to_store.
                        if ($min_partner_price) {
                            $id = $this->ProductToStoreUpdateOrCreate($min_partner_price);
                        }

                    }

                    $this->product_id = $row['ID для сайта'];

                    $store_id = $this->store_id;
                    $this->partner_id = Store::find($store_id)->partner_id;


                    /**Формируем массив данных для обновления цен в базе */
                    $store_id = $this->store_id;
                    if ((int)$row['Базовая цена Кения'] > 0 && $store_id > 0) {
                        $push_data[$r]['option_id'] = 15;
                        $push_data[$r]['option_value_id'] = $kenia_id;
                        $push_data[$r]['partner_price'] = (int)$row['Базовая цена Кения'];
                        $push_data[$r]['price'] = (int)ceil($row['ЦЕНА  + 127,9% Кения']);
                        $r++;

                    }
                    if ((int)$row['Базовая цена Эквадор'] > 0 && $store_id > 0) {
                        $push_data[$r]['option_id'] = 16;
                        $push_data[$r]['option_value_id'] = $ekvador_id;
                        $push_data[$r]['partner_price'] = (int)$row['Базовая цена Эквадор'];
                        $push_data[$r]['price'] = (int)ceil($row['ЦЕНА  + 127,9% Эквадор']);
                        $r++;

                    }
                    if ((int)$row['Базовая цена Без указания страны'] > 0 && $store_id > 0) {
                        $push_data[$r]['option_id'] = 2;
                        $push_data[$r]['option_value_id'] = $baze_id;
                        $push_data[$r]['partner_price'] = (int)$row['Базовая цена Без указания страны'];
                        $push_data[$r]['price'] = (int)ceil($row['ЦЕНА  + 127,9% Без указания страны']);
                        $r++;

                    }
                    if ((int)$row['Базовая цена Без указания страны'] > 0 && $store_id > 0 && $baze_id = 0) {
                        $push_data[$r]['option_id'] = 2;
                        $push_data[$r]['option_value_id'] = $baze_id;
                        $push_data[$r]['partner_price'] = (int)$row['Базовая цена Без указания страны'];
                        $push_data[$r]['price'] = (int)ceil($row['ЦЕНА  + 127,9% Без указания страны']);
                        $r++;
                        //Пропускаем строку если значения пустые
                    }
                    if ($row['Базовая цена Кения'] == '' &&
                        $row['Базовая цена Эквадор'] == '' &&
                        $row['Базовая цена Без указания страны'] == '') continue;


                    //Создаем или обновляем опции проходимся по массиву.
//                    dd($push_data);
                    foreach ($push_data as $arr) {
                        if ($arr['option_value_id'] > 0) {

                            //Через функцию получаем id обновленной или созданной опции.
                            $arr['product_option_id'] = $this->ProductOptionUpdateCreate($arr);

                            //Вызываем функцию создания или обновления ProductOptionValue получаем id записи
                            $id = $this->PoductOptionValueUpdateCreate($arr);
                        } elseif ($arr['option_value_id'] == 0) {
                            $this->ProductToStoreUpdateOrCreate($arr['partner_price']);
                        }


//
//                        session()->flash('file_to_database_error', 'Процесс загрузки в базу остановлен! В базе уже есть такие данные! Первое вхождение ID => ' . $search->id);
//                        return;
//
//                    }
                    }



                }
                session()->flash('file_to_database', 'Файл успешно загружен в базу  данных! В Город '.$this->real_name);
                DB::table('exel_price_load')->insertGetId([
                    'store_id' => $this->store_id,
                    'partner_id' => $this->partner_id,
                    'store_real_name' => $this->real_name,
                    'file_name' => $this->original_file_name,
                ]);
            } else {
                session()->flash('no_file', 'Файл не существует. Файл автоматически удаляется после загрузки в базу данных.');
                return;
            }


        }
        //Записываем в базу информацию о файле и городе.


        $this->store_id = 0; //обнуляем значения города для изключения ошибки повторной загрузки.
        //Удаляем файл после загрузки в базу.

        if ($this->exel_file_path) {
            unlink($this->exel_file_path);
            $this->exel_file_path = null;
        }

    }


    /**Функция обновления или создания
     * в случае отсутствия значения в таблице
     * "product_to_store"
     * возвращает id записи в базе
     */
    public
    function ProductToStoreUpdateOrCreate($partner_price)
    {
        return Product_to_store::updateOrCreate(
//                        Поля для проверки c
            ['store_id' => $this->store_id,
                'partner_id' => $this->partner_id,
                'product_id' => $this->product_id,

            ],
//                            Обновляем время и цены если запись есть и создаем если нет.
            [
                'partner_price' => $partner_price,
                'store_price' => $partner_price * 1.279,
                'updated_at' => date("Y-m-d H:i:s")
            ]

        )->id;
    }


    /**Функция возвращает минимальную цену
     * на товара и null, если опций у товара нет.
     */
    public
    function ProductOptionValueMinPrice()
    {
        return ProductOptionValue::where([
            ['product_id', '=', $this->product_id],
            ['store_id', '=', $this->store_id],
            ['partner_id', '=', $this->partner_id],
        ])->min('partner_price');
    }

    /**Функция обновления или создания
     * в случае отсутствия значения в таблице
     * "product_option"
     * возвращает id записи в базе
     */
    public
    function ProductOptionUpdateCreate($arr)
    {
        return ProductOption::updateOrCreate(
//                        Поля для проверки
            ['store_id' => $this->store_id,
                'partner_id' => $this->partner_id,
                'product_id' => $this->product_id,
                'option_id' => $arr['option_id'],
            ],
//                            Обновляем время если опция есть и создаем если нет.
            ['updated_at' => date("Y-m-d H:i:s")]

        )->id;

    }

    /**Функция обновления или создания
     * в случае отсутствия значения в таблице
     * "product_option_value"
     * возвращает id записи в базе
     */
    public
    function PoductOptionValueUpdateCreate($arr)
    {
        return ProductOptionValue::updateOrCreate(
        //      Поля для проверки
            ['store_id' => $this->store_id,
                'partner_id' => $this->partner_id,
                'product_option_id' => $arr['product_option_id'],
                'product_id' => $this->product_id,
                'option_id' => $arr['option_id'],
                'option_value_id' => $arr['option_value_id'],
            ],
//                            Обновляем время если есть такое занчение в базе и создаем если нет.
            ['updated_at' => date("Y-m-d H:i:s"),
                'quantity' => 1000,
                'subtract' => 1,
                'partner_price' => $arr['partner_price'],
                'price' => $arr['price'],
                'price_prefix' => '=',
                'points' => 0,
                'points_prefix' => '+',
                'weight' => 0,
                'weight_prefix' => '+',
                'updated_at' => date("Y-m-d H:i:s")

            ]

        )->id;
    }

    public
    function render()
    {
        $allStores = Store::all()->where('status' , 1)->sortBy('real_name');

        return view('livewire.exel.price-import-component', ['allStores' => $allStores])->layout('layouts.test');
    }
}
