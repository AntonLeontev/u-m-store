<?php

namespace App\Http\Livewire\Admin\CloneWebSite;

use App\Models\SEO\PartnerSeo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SiteCloneSeoSetting extends Component
{

    public $home_tags;
    public $category_tags;
    public $product_tags;
    public $metrika;
    public $seo;
    public function mount() {
      $this->seo = PartnerSeo::firstWhere('partner_id', Auth::user()->partner_id);
      if($this->seo) {
          $this->home_tags = $this->seo->home_tags;
          $this->category_tags  = $this->seo->category_tags;
          $this->product_tags = $this->seo->product_tags;
          $this->metrika = $this->seo->metrika;
      }
    }


    public function saveSeoTags() {
        if(!$this->seo) {
            $this->seo = new PartnerSeo();
            $this->seo->partner_id = Auth::user()->partner_id;
        }
        $this->seo->home_tags = $this->home_tags ;
        $this->seo->category_tags = $this->category_tags;
        $this->seo->product_tags = $this->product_tags;
        $this->seo->metrika = $this->metrika ;
        $this->seo->save();

    }

    public function render()
    {
        return view('livewire.admin.clone-web-site.site-clone-seo-setting')->layout('layouts.base');
    }
}
