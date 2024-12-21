<?php

namespace App\Http\Livewire\PWA;

use Livewire\Component;

class OfflineComponent extends Component
{
    public function render()
    {
        return view('livewire.p-w-a.offline-component')->layout('layouts.base');
    }
}
