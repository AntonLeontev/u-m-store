<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class BetaTestComponent extends Component
{
    public function beta_test()
    {
        session()->put('beta_test', true);
        Cookie::queue('beta_test', 'yes', 20160);
//        return redirect('/');
//        $this->redirect('/');
//        dd(Cookie::get('beta_test'));
    }

    public function render()
    {
        return view('livewire.beta-test-component');
    }
}
