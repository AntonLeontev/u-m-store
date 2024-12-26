<?php

namespace App\Http\Livewire\Admin\CloneWebSite;

use App\Models\CloneBottomSlider;
use App\Models\Clones\CloneSliders;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Manny\Manny;

class SiteCloneShopBottomSliderSettings extends Component
{
    use WithFileUploads;

    public $banner_image;
    public $sort;
    public $url;
    public $text_button;
    public $text_slider;
    public $dest_page;
    public $status;
    public $uploaded_banners;

    public $color_text_button;
    public $color_text_slider;
    public $color_button;
//    public $size_device;

    protected function rules()
    {
        $rules = [
//           'uploaded_banners.*.image'=>'max:8024|dimensions:min_width= 1300, max_width=1380, max_height=450',
            'uploaded_banners.*.sort' => 'numeric|min:1|max:20',
            'uploaded_banners.*.url' => 'url|max:250',
            'uploaded_banners.*.text_button' => 'max:20',
            'uploaded_banners.*.color_text_button' => '',
            'uploaded_banners.*.color_button' => '',
            'uploaded_banners.*.text_slider' => 'max:32',
            'uploaded_banners.*.color_text_slider' => '',
            'uploaded_banners.*.dest_page' => 'max:50',
            'banner_image' => 'max:8024|dimensions:min_width= 1300, max_width=1380, max_height=450',
            'sort' => 'numeric|min:1|max:20',
            'url' => 'url|max:250',
            'text_button' => 'max:20',
            'text_slider' => 'max:32',
            'dest_page' => 'max:50',
        ];
        return $rules;
    }

    protected $validationAttributes = [
        'banner_image' => 'Изображение баннера',

    ];
    protected $messages = [
//        'logo.max' => 'Логотип должен быть максимум 8 мегабайт',

    ];

    public function mount()
    {
        $this->uploaded_banners = $this->getAllBanners();
        $this->sort = 1;
        $this->url = 'https://vk.com';
        $this->text_button = 'Купить';
        $this->text_slider = 'Акция купи дешевле.';


    }

    public function updated($propertyName, $propertyValue)
    {
        $this->validateOnly($propertyName);

        if (str_starts_with($propertyName, 'uploaded_banners')) {
            $this->saveAllBanners();
        }
    }

    public function getAllBanners()
    {
        return CloneBottomSlider::where('partner_id', Auth::user()->partner_id)->get();
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
            $imageName = $partner_id . '_' . Carbon::now()->timestamp . '.' . $this->banner_image->extension();
            $imageName = $this->banner_image->storeAs('SiteClone/BottomBanners' . Carbon::now()->format('FY'), $imageName);

            if (session()->has('site_info_id')) {
				CloneBottomSlider::create([
					'partner_id' => Auth::user()->partner_id,
					'cs_info_id' => session()->get('site_info_id'),
					'sort' => $this->sort,
					'url' => $this->url,
					'text_button' => $this->text_button,
					'color_text_button' => $this->color_text_button,
					'color_button' => $this->color_button,
					'text_slider' => $this->text_slider,
					'color_text_slider' => $this->color_text_slider,
					'dest_page' => 'shop_page',
					'size_device' => 'desktop',
					'status' => 1,
					'moderation' => 0,
					'image' => $imageName,
				]);

                session()->flash('success_load');
            }
        } else {
            session()->flash('error');
        }

        redirect()->route('admin.shop.slider-bottom');
    }


    public function render()
    {
        return view('livewire.admin.clone-web-site.site-clone-shop-slider-settings')->layout('layouts.base');
    }
}

