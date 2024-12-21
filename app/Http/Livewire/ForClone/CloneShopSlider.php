<?php

namespace App\Http\Livewire\ForClone;

use App\Models\Clones\CloneSliders;
use Livewire\Component;

//use function React\Promise\all;

class CloneShopSlider extends Component
{
    public function render()
    {

        $banners = CloneSliders::where('partner_id', session()->has('clone_info') ? session()->get('clone_info')
        ['partner_id'] : 0)
            ->get();
//        $banners = CloneSliders::where('partner_id', session()->has('clone_info') ? session()->get('clone_info') : 0)->get();
//        $banners = '';
//            session()->has('clone_info')?session()->get('clone_info'):0);
//        compact('banners');
        return view('livewire.for-clone.clone-shop-slider', compact('banners'));
    }
}
