<?php

namespace App\Http\Controllers\Feed;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Checkout\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GetOrdersController extends Controller
{
    public function getOrders(Request $request, int $slug = 0)
    {
//        if($request->ip() === '195.216.211.123')
//        {
//            dd('Доступ разрешен ' .$request->ip());
//        }
//        else
//        {
//            dd('Доступ запрещен ' . $request->ip());
//        }
//        $request->getUser();
//        $request->getPassword();
//            return $request->secure();
            DB::table('ip_requests')->insert([
            'ip_client_request' => $request->ip(),
//            'auth_user' => Auth::user()->name
        ]);

        if($slug)
        {
            $All_orders = Order::where('status', StatusEnum::DELIVERED)->limit($slug)
                ->select('subtotal','total','status', 'city','country','created_at')
                ->get();
            $All_orders = Crypt::encryptString($All_orders);
//            return $request->ip();
            return json_encode($All_orders);
        }
        else
        {
            $All_orders = Order::where('status', StatusEnum::DELIVERED)
                ->select('subtotal','total','status', 'city','country','created_at')
                ->get();
            $All_orders = Crypt::encryptString($All_orders);
//            return $request->ip();
            return json_encode($All_orders);

        }

    }
}
