<?php

namespace App\Http\Livewire\ForClone\Info;

use App\Helpers\SiteClone\CloneInfo;
use App\Models\CloneSiteInformation;
use App\Models\Partners;
use Livewire\Component;

class ClonePolzovatelskoeSoglashenie extends Component
{

    public function mount()
    {

    }
    public function render()
    {
        if ($partner_id = CloneInfo::getParnterId())
        {
//            dd(session()->all());
            $partner = Partners::find($partner_id);
            $data = $partner->created_at->format('d.m.Y');
            $city = session()->get('city')['name'];
            $copyright_holder = $partner->partner_name;
            $inn = $partner->inn;
            $ogrn = $partner->ogrn_ip;
            $address = $partner->legal_address;
            $address_fact = $partner->actual_address;
            $email = session('clone_info')['email'];
            $phone = session('clone_info')['phone'];
        } else
        {
            $data = '27.02.2022';
            $city = 'КОМСОМОЛЬСК-НА-АМУРЕ';
            $copyright_holder = 'ИП Лихая Елизавета Руслановна';
            $inn = 'ИНН 250362174647';
            $ogrn = 'ОГРНИП  321272400049112';
            $address = 'Юридический адрес: 681000, ХАБАРОВСКИЙ КРАЙ, Г. КОМСОМОЛЬСК-НА-АМУРЕ, ЩЕГЛОВА ПЕР., 4, кв 6';
            $address_fact = 'Фактический адрес: Москва, г. Зеленоград, Улица Юности 8, офис 802';
            $email = '';
            $phone = '';
        }




        return view('livewire.for-clone.info.clone-polzovatelskoe-soglashenie', compact('data', 'inn', 'copyright_holder', 'ogrn', 'address','address_fact','city','phone','email'))->layout('layouts.base');
    }
}
