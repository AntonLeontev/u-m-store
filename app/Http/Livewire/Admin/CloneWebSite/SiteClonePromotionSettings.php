<?php

namespace App\Http\Livewire\Admin\CloneWebSite;

use App\Models\ClonePromotion;
use App\Models\Clones\CloneSliders;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Manny\Manny;

class SiteClonePromotionSettings extends Component
{
    use WithFileUploads;

    public $banner_image;
    public $sort;
    public $url;
    public $uploaded_banners;

    protected function rules()
    {
        return [
//           'uploaded_banners.*.image'=>'max:8024|dimensions:min_width= 1300, max_width=1380, max_height=450',
            'uploaded_banners.*.sort' => 'numeric|min:1|max:20',
            'uploaded_banners.*.url' => 'url|max:250',
            'banner_image' => 'max:8024|dimensions:min_width= 1300, max_width=1380, max_height=450',
            'sort' => 'numeric|min:1|max:20',
            'url' => 'url|max:250',
        ];
    }

    protected $validationAttributes = [
        'banner_image' => 'Изображение для акции',

    ];
    protected $messages = [
//        'logo.max' => 'Логотип должен быть максимум 8 мегабайт',

    ];

    public function mount()
    {
        $this->uploaded_banners = $this->getAllPromo();
        $this->sort = 1;
        $this->url = 'https://vk.com';
    }

    public function updated($propertyName, $propertyValue)
    {
        $this->validateOnly($propertyName);

        if (str_starts_with($propertyName, 'uploaded_banners')) {
            $this->saveAllBanners();
        }
    }

    public function getAllPromo()
    {
        return ClonePromotion::where('partner_id', Auth::user()->partner_id)->get();
    }

    public function saveAllBanners()
    {
        foreach ($this->uploaded_banners as $key => $uploaded_banner) {
            $uploaded_banner->save();
            session()->flash('success');
        }
        $this->emit('alert_remove');

    }

    public function deleteBanner($key)
    {
        $this->uploaded_banners[$key]->delete();
        //Удаление старого логотипа.

        if (!is_null($this->uploaded_banners[$key]->image)) {
            if (file_exists(public_path('storage/') . $this->uploaded_banners[$key]->image)) {
                unlink(public_path('storage/') . $this->uploaded_banners[$key]->image);
            }
        }
        unset($this->uploaded_banners[$key]);
    }

    public function saveSliderSettings()
    {
        $this->validate();

        $partner_id = Auth::user()->partner_id;

        if ($this->banner_image->extension()) {
            $imageName = 'SiteClone/Promotions' . Carbon::now()->format('FY') . '/' .$partner_id . '_' . Carbon::now()->timestamp . '.' . $this->banner_image->extension();
			Image::make($this->banner_image->temporaryUrl())->fit(300, 250)->save(public_path('storage/' . $imageName));

            if (session()->has('site_info_id')) {
                ClonePromotion::create(
                    [
                        'partner_id' => Auth::user()->partner_id,
                        'cs_info_id' => session()->get('site_info_id'),
                        'sort' => $this->sort,
                        'url' => $this->url,
                        'image' => $imageName,
                    ]
                );

                session()->flash('success_load');
            }
        } else {
            session()->flash('error');
        }

        redirect()->route('admin.shop.promotion');
    }


    public function render()
    {
        return view('livewire.admin.clone-web-site.site-clone-promotion-settings')->layout('layouts.base');
    }
}

