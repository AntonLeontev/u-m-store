<?php

namespace App\Http\Livewire\AdminManager;

use App\Models\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithHoney;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class AddCityComponent extends Component
{
    use WithHoney;
    use WithRecaptcha;
    public $new_city_name;
    public $status;
    public $slug;
    public $city_name;
    public $url_back;

    protected function rules()
    {
        //ООО rules
        $rules = [
            'new_city_name' => 'required|max:100|min:1|unique:stores,real_name',
            'status' => 'required|max:1',
            'slug' => 'required|max:100|unique:stores,slug',

        ];
        return $rules;
    }

    protected $validationAttributes = [
        'new_city_name' => 'Название города',
        'slug' => 'url города',
        'status' => 'Статус'
    ];

    public function mount($city_name)
    {
        $this->new_city_name = $city_name;
        $this->slug = Str::slug($this->new_city_name);
        $this->status = 0;
        $this->url_back = url()->previous();
    }

    public function updated($filds)
    {
        $this->slug = Str::slug($this->new_city_name);
        $this->validateOnly($filds);

    }

    public function addCityToBase()
    {
        $this->validate();
        if(!$this->honeyPasses())
        {
            return;
        }

        $store = Store::create([
            'partner_id' => 0,
            'slug' => $this->slug,
            'real_name' => $this->new_city_name,
            'status' => $this->status
        ]);
        if ($store) {
            session()->flash('message', 'Город успешно добавлен. id = ' . $store->id);
        } else {
            session()->flash('error-message', 'Возникла ошибка при добавлении города.');
            Log::warning('Error add new city in base. ' . url()->current());
        }
    }

    public function render()
    {
        return view('livewire.admin-manager.add-city-component')->layout('layouts.test');
    }
}
