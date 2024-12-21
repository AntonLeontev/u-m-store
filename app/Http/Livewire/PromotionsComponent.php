<?php

namespace App\Http\Livewire;

use App\Models\Directions;
use App\Models\Promotions;
use Livewire\Component;
use UmHelp;

class PromotionsComponent extends Component
{
//    dd(session()->all());


    public function render()
    {
        //Формирование SEO title, description, keywords
        $seo = UmHelp::SeoTransformationTemplates('Promotions');
        $directions = Directions::where('status', 1)->orderBy('sort')->get();
//        $promotions = Promotions::last;
//        dd();
        return view('livewire.promotions-component',compact('seo','directions'))->layout('layouts.base');
    }
}
