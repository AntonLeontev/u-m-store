<?php

namespace App\Http\Livewire\User;

use App\Enums\StatusEnum;
use App\Models\BonusTransactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;

class UserBonusComponent extends Component
{


    function incline($n){

        $words = array('день','дня','дней');
        if($n%100>4 && $n%100<20){
            return $words[2];
        }
        $a = array(2,0,1,1,1,2);
        return $words[$a[min($n%10,5)]];
    }

    public function render()
    {
        BonusTransactions::where('date_end' ,'<', Date::now())->update(['status' => StatusEnum::FINISHED]);
        $user_id = Auth::id();
        $bonuses_query = BonusTransactions::where('user_id', $user_id )->get();
        $user_bonuses_count = BonusTransactions::where('user_id', $user_id )->where('status', StatusEnum::BUYED)->sum('qty');
        if($bonuses_query)
        {
            $bonuses_history = [];
            $status = '';
            foreach ($bonuses_query as $query)
            {
                $dead_line = 0;
                switch ($query->status) {
                    case StatusEnum::BUYED:
                        $status = 'Начислено';
                        $updated_at = new Carbon($query->updated_at);
                        $date_end = new Carbon($query->date_end);
                        $dead_line = $date_end->diff($updated_at)->days;
                        break;
                    case StatusEnum::USED: $status = 'Использовано'; break;
                    case StatusEnum::FINISHED: $status = 'Истек срок действия'; $query->updated_at = $query->date_end; break;
                }

                $bonuses_history[] = array(
                    'date' => Date::parse($query->updated_at)->format('d.m.Y'),
                    'time' => Date::parse($query->updated_at)->format('H:i'),
                    'status' => $status,
                    'total' => $query->qty,
                    'dead_line' => $dead_line


                );
            }

        }

//        $created = new Carbon($query->updated_at);
//        $now = new Carbon($query->date_end);
////        $difference = ($created->diff($now)->days < 1)
////            ? 'today'
////            : $created->diffForHumans($now);
//
////        dd($now);
//        dd($now->diff($created)->days);

        return view('livewire.user.user-bonus-component', compact('bonuses_history', 'user_bonuses_count'))->layout('layouts.base');
    }
}
