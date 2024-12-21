<?php

namespace App\Http\Livewire\ForClone\Info;

use App\Models\Partners;
use Livewire\Component;
use function Symfony\Component\String\s;

class ClonePolitikaKonfidencialnosti extends Component
{

    public function render()
    {

        $partner_id = session()->get('clone_info')['partner_id'];
        $partner = Partners::find($partner_id);
        $domain_in_document = 'https://'. session()->get('domain').'/';
        $partner_name = session()->get('clone_info')['company_name'];
        $partner_email = session()->get('clone_info')['email'];
        return view('livewire.for-clone.info.clone-politika-konfidencialnosti', compact('domain_in_document', 'partner_name','partner_email'))
            ->layout('layouts.base');
    }
}
