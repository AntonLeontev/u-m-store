<?php

namespace App\Http\Livewire\Info;

use Illuminate\Http\Request;
use Livewire\Component;

class CooperationComponent extends Component
{

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
                default: $operator_name = 'Оператора нужно зарегистрировать!';
            }

            session()->put('operator', $operator_name);
        }
        return view('livewire.info.cooperation-component')->layout('layouts.base');
    }
}
