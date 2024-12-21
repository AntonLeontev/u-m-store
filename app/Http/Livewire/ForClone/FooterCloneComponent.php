<?php

namespace App\Http\Livewire\ForClone;

use App\Models\CloneSiteInformation;
use App\Models\SEO\PartnerSeo;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class FooterCloneComponent extends Component
{

    public function cookie()
    {
        session()->put('cookie', true);
        Cookie::queue('cookie', 'yes', 20160);
    }

    public function render()
    {
        dd(session()->has('clone_info'));
        return view('livewire.for-clone.footer-clone-component');
    }
}
