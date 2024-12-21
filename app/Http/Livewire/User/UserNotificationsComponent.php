<?php

namespace App\Http\Livewire\User;

use App\Models\Notifications;
use App\Models\User;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserNotificationsComponent extends Component
{

    public function clickItem($item_id){

        $notification = Notifications::find($item_id);
        if($notification)
            {
                $notification->read_status = 1;
                $notification->save();
            }

        session()->flash('message', $notification->description);

    }

    public function render()
    {
        $notifications = Notifications::where('user_id', (Auth::id()))->get();

        return view('livewire.user.user-notifications-component', [ 'notifications' => $notifications])->layout('layouts.base');
    }
}
