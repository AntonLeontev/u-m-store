<?php

namespace App\Http\Livewire\Includes;

use Livewire\Component;

class TokenizeComponent extends Component
{
    public $card;
    protected $listeners = ['refreshComponent' =>'$refresh'];

    public function getCard($card){
        $this->card = $card;
    }

    public function render()
    {
        return view('livewire.includes.tokenize-component');
    }
}
