<?php

namespace App\Http\Livewire\Info;

use Livewire\Component;

class DejstvuyushimPartneramComponent extends Component
{
    public function render()
    {
        $data = '06.08.2021';
        $data = '27.02.2022';
//        Юридический адрес: 191123, Россия,
//                    г.Санкт-Петербург, ул.Маяковского, д.37, литер В, помещение 20-Н.
        $copyright_holder = 'ИП Лихая Елизавета Руслановна';
        $inn = 'ИНН 250362174647';
        $ogrn = 'ОГРНИП  321272400049112';
        $address = 'Юридический адрес: 681000, ХАБАРОВСКИЙ КРАЙ, Г. КОМСОМОЛЬСК-НА-АМУРЕ, ЩЕГЛОВА ПЕР., 4, кв 6';
        $address_fact = 'Фактический адрес: Москва, г. Зеленоград, Улица Юности 8, офис 802';
        return view('livewire.info.dejstvuyushim-partneram-component', compact('data', 'inn', 'copyright_holder', 'ogrn', 'address','address_fact'));
    }
}
