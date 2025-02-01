<?php

namespace App\Http\Livewire;

use App\Models\Information;

use Illuminate\Http\Request;
use Livewire\Component;

class InformationComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render(Request $request)
    {
        if($request->utm_source)
        {
            switch ($request->utm_source) {
                case 'ip_1':
                    $operator_name = 'Екатерина';
                    break;
                case 'ip_4':
                    $operator_name = 'Евгений';
                    break;
                case 'ip_7':
                    $operator_name = 'Юля';
                    break;
                case 'ip_0':
                    $operator_name = 'Анастасия';
                    break;
                case 'ip_11':
                    $operator_name = 'Ринат';
                    break;
                case 'ip_10':
                    $operator_name = 'Маргарита';
                    break;

                default:
                    $operator_name = 'Оператора нужно зарегистрировать!';
            }

            session()->put('operator', $operator_name);
        }
        switch ($this->slug) {
            case 'o-nas':
                $article_name = 'О нас';
                break;
            case 'dejstvuyushim-partneram':
                $article_name = 'wiki';
                break;
            case 'dostavka':
                $article_name = 'Доставка';
                break;
            case 'katalog':
                $article_name = 'Каталог';
                break;
            case 'oplata':
                $article_name = 'Оплата';
                break;
            case 'politika-konfidencialnosti':
                $article_name = 'Политика конфиденциальности';
                break;
            case 'polzovatelskoe-soglashenie':
                $article_name = 'Пользовательское соглашение';
                break;
            case 'referalnaya-programma':
                $article_name = 'Реферальная программа';
                break;
            case 'sotrudnichestvo':
                $article_name = 'Сотрудничество';
                break;
            default:
                $article_name = 'Нет  такой статьи';

        }

		$article = Information::firstWhere('slug', $this->slug);

        return view('livewire.information-component', compact('article_name', 'article'))->layout('layouts.base');
    }
}
