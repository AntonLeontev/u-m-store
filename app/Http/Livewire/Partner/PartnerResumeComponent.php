<?php

namespace App\Http\Livewire\Partner;


use App\Helpers\UmHelp;
use App\Models\Partner\PartnerResume;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class PartnerResumeComponent extends Component
{
    use WithFileUploads;
    public $city;
    public $population;
    public $entity;
    public $store_name;
    public $store_address;
    public $store_description;
    public $phone;
    public $start_working;
    public $store_site;
    public $store_turnover;

    public $facebook_link;
    public $vk_link;
    public $instagram_link;
    public $telegram_link;
    public $odnoklassniki_link;
    //оборот
    public $month_turnover_in_socials;
    public $month_turnover;
    //расходы
    public $store_expenses;
    // количество персонала
    public $staff_count;
    //    арандуемая площадь
    public $leased_area;
    public $rental_price_per_month;

    public $taxation_system;

    public $store_image;
    public $partner_id;
    protected function rules()
    {
        $rules = [
            'city' => 'required',
            'population' => 'required',
            'entity' => 'required',
            'store_name' => 'required',
            'store_address' => 'required',
            'store_description' => 'required',
            'phone' => 'required|max:20',
            'start_working' => 'required|max:10',
            'staff_count' => 'required|max:10',
            'leased_area' => 'required|max:10',
        ];

        return $rules;
    }


    public function submitForm() {

        $this->validate();

        $resume = new PartnerResume();
        $resume->partner_id = $this->partner_id;
        $resume->city = $this->city;
        $resume->population = $this->population;
        $resume->entity = $this->entity;
        $resume->store_name = $this->store_name;
        $resume->store_address = $this->store_address;
        $resume->store_description = $this->store_description;
        $resume->phone = $this->phone;
        $resume->start_working = $this->start_working;
        $resume->store_site = $this->store_site;
        $resume->store_turnover = $this->store_turnover;

        $resume->facebook_link = $this->facebook_link;
        $resume->vk_link = $this->vk_link;
        $resume->instagram_link = $this->instagram_link;
        $resume->telegram_link = $this->telegram_link;
        $resume->odnoklassniki_link = $this->odnoklassniki_link;
        //оборот
        $resume->month_turnover_in_socials = $this->month_turnover_in_socials;
        $resume->month_turnover = $this->month_turnover;
        //расходы
        $resume->store_expenses = $this->store_expenses;
        // количество персонала
        $resume->staff_count = $this->staff_count;
        //    арандуемая площадь
        $resume->leased_area = $this->leased_area;
        $resume->rental_price_per_month = $this->rental_price_per_month;
        $resume->taxation_system = $this->taxation_system;
        $resume->save();

        $this->loadImages();

        $send_arr = array(
            'Cтраница' => route('partner.resume'),
        'ID партнера' => $this->partner_id,
        'Город' => $this->city,
        'Население города' => $this->population,
        'Юридическое лицо' => $this->entity,
        'Название магазина' => $this->store_name,
        'Адрес магазина' => $this->store_address,
        'Краткое описание магазина' => $this->store_description,
        'Телефон магазина' => $this->phone,
        'С какого года (сколько лет) работает Ваш магазин' => $this->start_working,
        'Сайт магазина (при наличии)' => $this->store_site,
        'Товарооборот в месяц с сайта(при наличии)' => $this->store_turnover,
        'facebook' => $this->facebook_link,
        'vk' => $this->vk_link,
        'instagram' => $this->instagram_link,
        'telegram' => $this->telegram_link,
        'одноклассники' => $this->odnoklassniki_link,
        'Товарооборот в месяц с социальных сетей' => $this->month_turnover_in_socials,
        'Товарооборот в месяц магазина' => $this->month_turnover,
        'Расходы магазина в месяц' => $this->store_expenses,
        'Сколько флористов работает, персонал' => $this->staff_count,
        'Арендуемая площадь, м2' => $this->leased_area,
        'Стоимость аренды в месяц' => $this->rental_price_per_month, 'Система налогооблажения' => $this->taxation_system
    );

        $this->reset('city','population','entity','store_address','store_description','phone','start_working','store_site','store_turnover','facebook_link','vk_link','instagram_link','telegram_link','odnoklassniki_link','month_turnover_in_socials','month_turnover','store_expenses','staff_count', 'leased_area','rental_price_per_month','taxation_system','store_image','store_name');

        $response = UmHelp::sendTelegramToManager($send_arr,'Анкета "Партнер Onion Market"');

                if($response) session()->flash('success');
                else session()->flash('error');
    }

    public function loadImages(){
        $folder = $this->city. '_' . $this->partner_id;

        foreach($this->store_image as $key => $image) {
            if($key == 5) continue;
            // timestamp единый для всех изображений
            $timestamp = Carbon::now()->timestamp;
        $imgName = $timestamp . $key . '.' . $image->extension() ;
        $image_path = $image->storeAs('stores/'. $folder, $imgName);
            DB::table('store_images')
                ->insert([
                    'partner_id' => $this->partner_id,
                    'image' => $image_path
                ]);
    }
    }

    public function render()
    {

       $this->partner_id = Auth::check() ? Auth::user()->partner_id : false;
       if(!$this->partner_id)  return view('livewire.partner.you-not-status-parner-componet')->layout('layouts.base');

        return view('livewire.partner.partner-resume-component')->layout('layouts.base');
    }

}
