<?php

namespace App\Http\Livewire\Includes;

use Livewire\Component;

class WishlistCountComponent extends Component
{
    protected $listeners = ['refreshComponent' =>'$refresh'];

    public function render()
    {
        return view('livewire.includes.wishlist-count-component');
    }
}
