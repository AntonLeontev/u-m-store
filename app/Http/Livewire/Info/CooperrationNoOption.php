<?php

namespace App\Http\Livewire\Info;

use App\Helpers\UmHelp;
use App\Models\QuestionsRemainGeneralPartner;
use Illuminate\Http\Request;
use Livewire\Component;

class CooperrationNoOption extends Component
{
    public $questions_name;
    public $questions_phone;
    public $questions_email;
    public $questions_message;

    public function questionsRemain()
    {
        $this->validate([
            'questions_name' => 'required|max:60',
            'questions_phone' => 'required|max:20',
            'questions_email' => 'required|max:60',
            'questions_message' => 'required|max:250',

        ]);
        #Write to database
        $question = QuestionsRemainGeneralPartner::create([
            'status' => 'CREATE',
            'questions_name' => $this->questions_name,
            'questions_phone' => $this->questions_phone,
            'questions_email' => $this->questions_email,
            'questions_message' => $this->questions_message,
        ]);
        #Send a message to telegram
        $question_arr = $question->toArray();
        $question_arr['Вопрос №'] = $question_arr['id'];
        $question_arr['Источник'] = url()->current();
        $question_arr['Имя'] = $question_arr['questions_name'];
        $question_arr['Телефон'] = $question_arr['questions_phone'];
        $question_arr['Email адрес'] = $question_arr['questions_email'];
        $question_arr['Текст сообщения'] = $question_arr['questions_message'];

        unset($question_arr['created_at']);
        unset($question_arr['updated_at']);
        unset($question_arr['status']);
        unset($question_arr['id']);
        unset($question_arr['questions_name']);
        unset($question_arr['questions_phone']);
        unset($question_arr['questions_email']);
        unset($question_arr['questions_message']);


        $response = UmHelp::sendTelegramToManager($question_arr,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', config('telegram.chats.applications'));
        $this->reset(['questions_name', 'questions_phone','questions_email','questions_message']);
        if ($response) {
			session()->flash('success_question');
		} else {
			session()->flash('error_question');
            $this->emit('alert_remove');
		}
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
                default: $operator_name = 'Оператора нужно зарегистрировать!';
            }

            session()->put('operator', $operator_name);
        }
        return view('livewire.info.cooperration-no-option')->layout('layouts.base');
    }
}
