<?php

namespace App\Http\Livewire\Admin;

use App\Models\DeliveryPrice;
use App\Models\Directions;
use App\Models\Partner\DeliveryAddresses;
use App\Models\Partners;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminSettingsComponent extends Component
{

    public $org_name;
    public $partner_name;
    public $telephone;
    public $socials;
    public $email;
    public $inn;
    public $ogrn;
    public $bik;
    public $kor_account;
    public $bank_account;
    public $legal_address;
    public $actual_address;
    public $delivery_price;
    public $delivery_prices = [];
    public $delivery_addresses = [];
    public $description;

    public $partner_type;
    public $organistion_name;
    public $org_full_name;

    public $director_name;
    public $bohalter_name;
    public $mobile_tel_owner;
    public $bank_name;
    public $kpp;
    public $ogrn_ip;
    public $post_address;

    public $fio;
    public $passport_data;
    public $reg_address;
    public $who_gave;


    public $city_name;
    public $direction;
    public $org_short_name;
    public $shop_name;

    public $site_status;


    public function mount()
    {
        $user = auth()->user();

        if($user) {
			$partner = Partners::find($user->partner_id);
			if($partner) {

				$this->site_status = $partner->site_status;

				$this->org_name = $partner->organisation_name;

				$this->org_short_name = $partner->partner_name;
				$this->telephone = $partner->telephone;
				$this->socials = $partner->socials;
				$this->email = $partner->email;
				$this->inn = $partner->inn;
				$this->ogrn = $partner->ogrn;
				$this->bik = $partner->bik;
				$this->kor_account = $partner->kor_account;
				$this->bank_account = $partner->bank_account;
				$this->legal_address = $partner->legal_address;
				$this->actual_address = $partner->actual_address;
				$this->delivery_price = $partner->delivery_price;
				$this->delivery_prices = $partner->deliveryPrices;
				$this->description = $partner->description;

				//Добавил переменные для разных типов партнеров.
				$this->city_name = Store::find($partner->store_id)->real_name;
				$this->direction = Directions::find($partner->direction_id)->name;
				$this->partner_type = $partner->partner_type;
				$this->organistion_name = $partner->organistion_name;
				$this->org_full_name = $partner->org_full_name;
				$this->director_name = $partner->director_name;
				$this->bohalter_name = $partner->bohalter_name;
				$this->mobile_tel_owner = $partner->mobile_tel_owner;
				$this->bank_name = $partner->bank_name;
				$this->kpp = $partner->kpp;
				$this->ogrn_ip = $partner->ogrn_ip;
				$this->post_address = $partner->post_address;
				$this->fio = $partner->fio;
				$this->passport_data = $partner->passport_data;
				$this->reg_address = $partner->reg_address;
				$this->who_gave = $partner->who_gave;
				$this->shop_name = $partner->organisation_name;



				$ready_delivery_addresses = DeliveryAddresses::where('partner_id', $partner->id)->get();
				if($ready_delivery_addresses)
				{
					foreach($ready_delivery_addresses as $address)
					{
						$this->delivery_addresses[] = $address->address;
					}

				}


			}
		}
    }


    public function setSettings()
    {
        $user = auth()->user();

        if($user)
        {
            $partner = Partners::find($user->partner_id);
            if(!$partner) $partner = new Partners();
            if($partner)
            {
                $partner->user_id = $user->id;
                $partner->organisation_name = $this->org_name;
                $partner->partner_name = $this->partner_name;
                $partner->telephone = $this->telephone;
                $partner->socials = $this->socials;
                $partner->email = $this->email;
                $partner->inn = $this->inn;
                $partner->ogrn = $this->ogrn;
                $partner->bik = $this->bik;
                $partner->kor_account = $this->kor_account;
                $partner->bank_account = $this->bank_account;
                $partner->legal_address = $this->legal_address;
                $partner->actual_address = $this->actual_address;
                $partner->delivery_price = $this->delivery_price ? : NULL;
				$partner->description = $this->description;

                //Добавил переменные для разных типов партнеров  январь 2022.
				$partner->partner_type = $this->partner_type;
				$partner->org_full_name = $this->org_full_name;
				$partner->director_name = $this->director_name;
				$partner->bohalter_name = $this->bohalter_name;
				$partner->mobile_tel_owner = $this->mobile_tel_owner;
				$partner->bank_name = $this->bank_name;
				$partner->kpp = $this->kpp;
				$partner->ogrn_ip = $this->ogrn_ip;
				$partner->post_address = $this->post_address;
				$partner->fio = $this->fio;
				$partner->passport_data = $this->passport_data;
				$partner->reg_address = $this->reg_address;
				$partner->who_gave = $this->who_gave;
				$partner->organisation_name = $this->shop_name;


                $partner->save();

                if($this->delivery_addresses && count($this->delivery_addresses) > 0)
                {
                    DeliveryAddresses::where('partner_id', $partner->id)->delete();
                    foreach ($this->delivery_addresses as $address)
                    {
                        if($address)
                        {
                            DeliveryAddresses::create([
                                'partner_id' => $partner->id,
                                'address' => $address,
                                'status' => 1
                            ]);
                        }
                    }
                }

				if($this->delivery_prices && count($this->delivery_prices) > 0)
				{
					foreach ($this->delivery_prices as $price) {
						if(isset($price['id'])) {
							DeliveryPrice::where('id', $price['id'])->update([
								'region' => $price['region'],
								'price' => $price['price']
							]);
						} else {
							DeliveryPrice::create([
								'partner_id' => $partner->id,
								'region' => $price['region'],
								'price' => $price['price']
							]);
						}
					}
				}

                session()->flash('success', true);
            }
        }
    }

	protected function rules() {
		return [
			'delivery_prices' => ['array', 'nullable'],
			'delivery_prices.*.region' => ['required', 'string', 'max:250'],
			'delivery_prices.*.price' => ['required', 'numeric', 'min:0'],
		];
	}

    public function render()
    {
        return view('livewire.admin.admin-settings-component')->layout('layouts.base');
    }
}
