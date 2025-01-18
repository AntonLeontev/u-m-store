<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminPartnersComponent extends Component
{
	public string $organizationName;
	public string $inn = '';
	public string $fullName = '';
	public string $phoneNumber = '';
	public string $cityCode = '';
	public string $region = '';

	public Collection $regions;
	public Collection $cities;

	public function mount()
	{
		$this->regions = DB::table('regions')->orderBy('name')->get();
		$this->cities = collect();
	}

	public function render()
	{
		return view('livewire.admin.admin-partners-component')->layout('layouts.base');
	}
}
