<?php

namespace App\Http\Livewire\AdminHacker;

use App\Models\Directions;
use App\Models\FakeReviewsData;
use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use SimpleXLSX;
use Illuminate\Support\Facades\Storage;

class HackingCabinet extends Component
{
    use WithFileUploads;

    public $direction_id;
    public $exel_file;


    public function save()
    {
        $this->validate([
            'exel_file' => 'max:1024', // 1MB Max
        ]);
        if (!is_null($this->exel_file)) {
            $this->exel_file->storeAs('exel_downloads', 'reviews.xlsx');
            session()->flash('file_load', 'Файл успешно загружен!');
        }
    }

    public function loadExelIntoDatabase()
    {
        /**
         * Функция загружает данные из exel файла в базу данных.
         * Формат файла должен быть xlsx
         */
        if ((Storage::disk('local')->exists('/exel_downloads/reviews.xlsx'))) {
            //Получаем полный путь к файлу.
            $exel_file = Storage::path('exel_downloads/reviews.xlsx');
            //Делаем заголовки столбцов ключами дли доступа к элементам массива
//            dd($exel_file);
            if ($xlsx = SimpleXLSX::parse($exel_file)) {
                //Переводим все значения дата в unix time
                $xlsx->setDateTimeFormat('U');
                // Производим ключи массива из значений массива 1-го элемента массива
                $header_values = $rows = [];
                foreach ($xlsx->rows() as $k => $r) {
                    if ($k === 0) {

                        $header_values = $r;

                        if ($r[0] == 'Дата' && $r[1] == 'Имя' && $r[2] == 'Отзыв') {
                            continue;
                        } else {
                            session()->flash('file_to_database_error', 'Файл не загружен в базу данных! Неверный формат файла. Заголовки столбцов должны быть "Дата" "Имя" "Отзыв"!');
                            return;
                        }

                    }
                    $rows[] = array_combine($header_values, $r);
                }

            }

            //Загружаем массив в базу
            foreach ($rows as $row) {
                //Проверяем есть ли такие уже такие данные в базе
                $search = FakeReviewsData::where('user_name', $row['Имя'])->where('reviews', $row['Отзыв'])->first();
                if (is_null($search)) {
                    FakeReviewsData::create([
                            'data' => date('d.m.Y', $row['Дата']),
                            'user_name' => $row['Имя'],
                            'reviews' => $row['Отзыв']
                        ]
                    );
                } else {
                    session()->flash('file_to_database_error', 'Процесс загрузки в базу остановлен! В базе уже есть такие данные! Первое вхождение ID => ' . $search->id);
                    return;

                }
            }
            session()->flash('file_to_database', 'Файл успешно загружен в базу  данных!');
        }
    }

    public function makeFakeUser()
    {
        /**
         * Функция создает фейковых пользователей в таблице users.
         * Данные берутся из таблицы fake_reviews_data
         * Если у записи есть user_id то новый пользователь не генерируется
         */
        $fake_reviews_data = FakeReviewsData::all();

        foreach ($fake_reviews_data as $data) {

            if ($data->user_name && is_null($data->user_id)) {
                //generate username
                $u_name = Str::slug($data->user_name);
                //generate phone
                $phone = '989' . $u_name . random_int(1, 30);
                //cut off extra characters
                $phone = Str::limit($phone, 20, '');
                //generate password
                $password = md5('K%jTf^963v2azL!23^NHCJVp2;c*&d(9');
                //generate email
                $email = $u_name . '@fake.ru';
                $search = (User::where('email', $email)->first());
                if(is_null($search))
                {
                    User::create(['name' => $u_name,
                        'phone' => $phone,
                        'email' => $email, 'password' => $password
                    ]);
                    //Поиск последнего id в таблице
                    $last_id = User::latest('id')->first();
                    //Сохраняем этот id в таблице fake_reviews
                    $data->user_id = $last_id->id;
                    $data->save();
                    session()->flash('user_make', 'Пользователи успешно созданы');
                } else {
                    session()->flash('user_make_error', 'Ошибка! Такие пользователи уже есть в базе!');
                    return;
                }

            }
        }
    }

    public function makeFakeReviews()
    {

        /**
         * Функция создает фейковые отзывы в таблице products_reviews.
         * Данные берутся из таблицы fake_reviews_data.
         *
         */

        if (is_null($this->direction_id)) {
            $this->direction_id = 1;
        }
//        dd($this->direction_id);
        $fake_reviews_data = FakeReviewsData::all();
        $product_count = Product::where('direction_id', $this->direction_id)->count();
        if ($product_count<1)
        {
            session()->flash('reviews_error', 'В выбранной категории нет товаров. Скрипт остановлен');
            return;
        }
        $category = Directions::find($this->direction_id)->name;

        $count_r = 0;
        foreach ($fake_reviews_data as $data) {
            if(is_null($data->user_id))
            {
                session()->flash('reviews_error', 'Не сгенерированны все пользователи для отзывов! Скрипт остановлен.');
                return;
            }
            if ($data->user_name && is_null($data->status)) {
                do {
                    $random_id_product = random_int(1, $product_count);
                } while (is_null(Product::find($random_id_product)));

                ProductReviews::create(['product_id' => $random_id_product,
                    'user_id' => $data->user_id,
                    'theme' => 'Пожелания/ Замечания',
                    'category' => $category,
                    'review' => $data->reviews
                ]);
                $data->status = 1;
                $data->save();
                $count_r++;

            }

        }
        session()->flash('reviews', 'Отзывы успешно созданы в выбранную категорию! Количество отзывов '. $count_r .' Продуктов в категории '. $product_count);
    }

    public function render()
    {
        $directions = Directions::all();
        return view('livewire.admin-hacker.hacking-cabinet', compact('directions'))->layout('layouts.test');

    }
}
