<?php

namespace App\Http\Livewire\Includes;

use App\Models\Store;
use Livewire\Component;
use Cart;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent' =>'$refresh'];

    public function render()
    {

        session()->put(Store::store_id(), Store::store_id());
        return view('livewire.includes.cart-count-component');
    }
}
