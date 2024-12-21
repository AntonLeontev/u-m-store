<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserReferralComponent extends Component
{
    public function render()
    {
//        dd(User::find(Auth::id())->referral_slug);
        return view('livewire.user.user-referral-component', ['referral_link' => User::find(Auth::id())->referral_slug])->layout('layouts.base');
    }
}
