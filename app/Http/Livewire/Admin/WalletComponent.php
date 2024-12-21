<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class WalletComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.wallet-component')->layout('layouts.base');
    }
}
