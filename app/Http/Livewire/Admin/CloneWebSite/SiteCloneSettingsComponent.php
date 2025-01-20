<?php

namespace App\Http\Livewire\Admin\CloneWebSite;

use App\Models\CloneSiteInformation;
use App\Models\Partners;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageServiceProvider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Manny\Manny;
use Telegram\Bot\Laravel\Facades\Telegram;

use function Symfony\Component\String\s;

class SiteCloneSettingsComponent extends Component
{
    use WithFileUploads;

    public $domain;
    public $city_name;
    public $company_name;
    public $phone_number;
    public $email;
    public $address;
    public $vk_link;
    public $inst_link;
    public $fb_link;
    public $youtube_link;

	public $logoOrdered = false;
	public $domainOrdered = false;

    #IMAGES
    public $logo;
//    public $banners = [];

    protected function rules()
    {
        $rules = [
            'domain' => 'sometimes|nullable|max:50',
            // 'city_name' => 'required|max:100',
            'company_name' => 'required|max:100',
            'phone_number' => 'required|max:20',
            'email' => 'required|email|max:50',
            'address' => 'required|max:250',
		//            'banners' => 'image',
		//            'inst_link' => 'max:250|url',
		//            'fb_link' => 'max:250|url',
		//            'youtube_link' => 'max:250|url',
        ];
        if (strlen($this->vk_link) > 1) {
            $rules['vk_link'] = 'max:250|url';
        }
        if (strlen($this->inst_link) > 1) {
            $rules['inst_link'] = 'max:250|url';
        }
        if (strlen($this->fb_link) > 1) {
            $rules['fb_link'] = 'max:250|url';
        }
        if (strlen($this->youtube_link) > 1) {
            $rules['youtube_link'] = 'max:250|url';
        }
        #Правило для логотипа
        if (!is_string($this->logo)) {
            $rules['logo'] = 'nullable|image|max:8069';
        }
		//        #Правило для баннеров.
		//        if (!is_string($this->banners)) {
		//            $rules['banners.*'] = 'image|max:8024';
		//        }

        return $rules;
    }

    protected $validationAttributes = [
        'logo' => 'Логотип',
        'domain' => 'Домен',
        'city_name' => 'Название города',
        'company_name' => 'Название компании',
        'phone_number' => 'Телефонный номер',
        'email' => 'e-mail Адрес',
        'address' => 'Адрес',
        'vk_link' => 'Ссылка ВК',
        'inst_link' => 'Ссылка Instagram',
        'fb_link' => 'Ссылка Facebook',
        'youtube_link' => 'Ссылка youtube',
    ];
    protected $messages = [
        'logo.max' => 'Логотип должен быть максимум 8 мегабайт',

    ];

    public function mount()
    {

//        $city_name = Store::find();
        $site_info = CloneSiteInformation::firstWhere('partner_id', Auth::user()->partner_id);
        if ($site_info) {
            $this->domain = $site_info->domain;
            $this->logo = $site_info->logo;
            $this->city_name = $site_info->city_name;
            $this->company_name = $site_info->company_name;
            $this->phone_number = $site_info->phone;
            $this->email = $site_info->email;
            $this->address = $site_info->address;
            $this->vk_link = $site_info->vk_link;
            $this->inst_link = $site_info->inst_link;
            $this->fb_link = $site_info->fb_link;
            $this->youtube_link = $site_info->youtube_link;

            session()->put('site_info_id', $site_info->id);
        } else {
            $parntner = Partners::find(Auth::user()->partner_id);

            if ($parntner) {
                $this->city_name = Store::find($parntner->store_id)->real_name;
            };
        }

    }

    public function updated($propertyName, $propertyValue)
    {
        if ($propertyName == 'phone_number' and strlen($propertyValue) > 10) {
            $this->phone_number = Manny::mask($propertyValue, '1(111) 111 11 11');
        }
        $this->validateOnly($propertyName);

    }

    public function saveSiteSettings()
    {
//        dd($this->banners[0], $this->logo);
        $this->validate();

        $partner = Partners::find(Auth::user()->partner_id);

        // Eсли еще нет записи о сайте для этого партнера или найдена запись этого партнера.
        if (is_null($clone_site = CloneSiteInformation::firstWhere('domain', $this->domain))
            or
            $clone_site->partner_id == $partner->id) {

            // Если загружено новое фото кропаем его 250*250 пикселей и сохраняем.
            if (is_object($this->logo)) {
				if (!file_exists(public_path('storage/SiteClone/Logo/'))) {
					mkdir(public_path('storage/SiteClone/Logo/'), 0777, true);
				}

                if ($this->logo->extension()) {
                    $imageName = $partner->id . '_' . Carbon::now()->timestamp . '.' . $this->logo->extension();
			//      $imageName = $this->logo->storeAs('SiteClone/Logo' . Carbon::now()->format('FY'), $imageName);
                    //Снимаем ограничение на объем выделяемой памяти.
                    ini_set('memory_limit', '-1');
                    $destinationPath = public_path('storage/SiteClone/Logo/') . $imageName;
                    Image::make($this->logo->temporaryUrl())->resize(250, 250, function ($constraint) {
                        $constraint->aspectRatio();
                    })->orientate()->save($destinationPath);
                }

                //Удаление старого логотипа.
                if (!is_null($clone_site)) {
                    if (file_exists(public_path('storage/SiteClone/Logo/') . $clone_site->logo)) {
                        unlink(public_path('storage/SiteClone/Logo/') . $clone_site->logo);
                    }
                }

            } else {
                $imageName = $this->logo ?? 'logo';
            }

			//            //Если загружены баннеры сохраняем их в базу.
			//            if(isset($this->banners[0]) and is_object($this->banners[0]))
			//            {
			//
			//            }

            //Обновляем или сохраняем данные
            CloneSiteInformation::updateOrCreate(
                ['partner_id' => $partner->id],
                [
                    'store_id' => $partner->store_id,
                    'direction_id' => $partner->direction_id,
                    // 'domain' => $this->domain,
                    'city_name' => $this->city_name,
                    'company_name' => $this->company_name,
                    'phone' => $this->phone_number,
                    'email' => $this->email,
                    'address' => $this->address,
                    'vk_link' => $this->vk_link,
                    'inst_link' => $this->inst_link,
                    'fb_link' => $this->fb_link,
                    'youtube_link' => $this->youtube_link,
                    'logo' => $imageName,
                ]
            );
            session()->forget('clone_info');

            session()->flash('success');
        } else {
            session()->flash('error');
        }

    }

	public function orderDomain() {
		$user = auth()->user();

		$message = "Пользователь $user->id " . $user->name . ' ' . $user->email . ' ' . $user->phone . ' хочет установить домен ' . $this->domain;

		Telegram::sendMessage([
			'chat_id' => config('telegram.chats.applications'),
			'text' => $message,
		]);

		$this->domainOrdered = true;

		return view('livewire.admin.clone-web-site.site-clone-settings-component')->layout('layouts.base');
	}

	public function orderLogo() {
		$user = auth()->user();

		Telegram::sendMessage([
			'chat_id' => config('telegram.chats.applications'),
			'text' => "Пользователь $user->id " . $user->name . ' ' . $user->email . ' ' . $user->phone . ' хочет заказать логотип на сайте',
		]);

		$this->logoOrdered = true;

		return view('livewire.admin.clone-web-site.site-clone-settings-component')->layout('layouts.base');
	}

    public function render()
    {
        return view('livewire.admin.clone-web-site.site-clone-settings-component')->layout('layouts.base');
    }
}
