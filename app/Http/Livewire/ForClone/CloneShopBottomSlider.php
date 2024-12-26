<?php

namespace App\Http\Livewire\ForClone;

use App\Models\CloneBottomSlider;
use App\Models\Clones\CloneSliders;
use Livewire\Component;

//use function React\Promise\all;

class CloneShopBottomSlider extends Component
{
    public function render()
    {
        $banners = CloneBottomSlider::where('partner_id', session()->has('clone_info') ? session()->get('clone_info')
        ['partner_id'] : 0)
            ->get();
			
//        $banners = CloneSliders::where('partner_id', session()->has('clone_info') ? session()->get('clone_info') : 0)->get();
//        $banners = '';
//            session()->has('clone_info')?session()->get('clone_info'):0);
//        compact('banners');
        return view('livewire.for-clone.clone-shop-bottom-slider', compact('banners'));
    }
}
