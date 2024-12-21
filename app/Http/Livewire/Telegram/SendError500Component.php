<?php

namespace App\Http\Livewire\Telegram;

use Illuminate\Http\Request;
use Livewire\Component;
use Telegram\Bot\Laravel\Facades\Telegram;

class SendError500Component extends Component
{
    public static function sendError500(Request $request, $chat_id = '464744447', $title='Oшибка на сайте')
    {
        $arr_request = $request->toArray();
//        dd($arr_request);
        $view ='livewire.telegram.send-error500-component';
        $response = Telegram::sendMessage([
            'chat_id' => '464744447',
            'parse_mode' => 'HTML',
            'text' => view($view, compact('arr_request','title'))->render()

        ]);
        if(isset($response))
        {
            return redirect()->route('home');
        }


    }
    public function render()
    {
        return view('livewire.telegram.send-error500-component');
    }
}
