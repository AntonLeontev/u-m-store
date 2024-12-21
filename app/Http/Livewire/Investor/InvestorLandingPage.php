<?php

namespace App\Http\Livewire\Investor;

use App\Helpers\UmHelp;
use App\Models\Directions;
use App\Models\Store;
use Illuminate\Http\Request;
use Livewire\Component;

class InvestorLandingPage extends Component
{
    public function render(Request $request)
    {
        if($request->utm_source) {
            switch($request->utm_source) {
                case 'ip_1':
                    $operator_name = 'Eкатерина';
                    break;
                case 'ip_4':
                    $operator_name = 'Eвгений';
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

        
        return view('livewire.investor.investor-landing-page')->layout('layouts.base');
    }

    public $name;
    public $investor_id;
    public $phone;
    public $email;

    public function sendRequest(){

        $this->validate([
            'name' => 'required|max:60',
            'phone' => 'required|max:20',
            'email' => 'required|max:60',
        ]);
        $question_arr = array(
            'Имя' => $this->name,
            'ID торговой точки' => $this->investor_id,
            'Телефон' => $this->phone,
            'email' => $this->email
        );
//
        session()->has('operator') ? $question_arr['Оператор'] = session()->get('operator') : $question_arr['Оператор'] = 'Нет оператора';
                UmHelp::sendTelegramToManager($question_arr,'ЗАЯВКА НА СОТРУДНИЧЕСТВО ОТ ИНВЕСТОРА!');
        UmHelp::sendTelegramToManager($question_arr,'ЗАЯВКА НА СОТРУДНИЧЕСТВО ОТ ИНВЕСТОРА!', 464744447);
        UmHelp::sendTelegramToManager($question_arr,'ЗАЯВКА НА СОТРУДНИЧЕСТВО ОТ ИНВЕСТОРА!', 265481925);

        $this->reset(['name', 'phone','email','investor_id']);
        if ($question_arr) session()->flash('success_question');
        else session()->flash('error_question');
//        $this->emit('alert_remove');
    }
}
