<?php

namespace App\Http\Livewire;

use App\Models\Directions;
use App\Models\Store;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Cart;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;


class FooterComponent extends Component
{
    public $search_city;

//    For location by ip
    public $location_city;
    public $user_location;
    public $city_slug;
    public $user_ip;
    public $direction_slug;

    public function mount(Request $request) {
        session()->put('url', url()->current());
        session()->put('route_name', Route::current()->getName());
        session()->put('slug', Route::current()->slug);
        #Сохранение в сессию параметра qr кода
        if($request->qr) session()->put('qr',$request->qr);

        #Сохранение в сессию параметров сертификата.
        if($request->certificate) session()->put('certificate',$request->certificate);
        if($request->certificate_type) session()->put('certificate_type',$request->certificate_type);

        $this->direction_slug = Route::current()->direction_slug;
//        cache()->forget('cookie');
    }

    public function city($city, $slug, $url)
    {
        session()->put('city', ['name' => $city, 'slug' => $slug] );
        Cookie::queue('city_name',$city, 10080);
        Cookie::queue('city_slug',$slug, 10080);
        session()->forget('needCity');
//        dd($url);
        $this->redirect($url);
        if($this->user_ip)
        {
            Cart::instance('cart')->destroy();
            Cart::instance('cart')->restore($this->user_ip.Store::store_id());

            Cart::instance('wishlist')->destroy();
            Cart::instance('wishlist')->restore($this->user_ip.Store::store_id());
        }

    }

    public function searchCity($search) {
        if(strlen($search) > 1)
        {
        $search_city = Store::where('status', 1)->where('real_name', 'like', $search. '%')->get();
        if($search_city) {
            $this->search_city = $this->getStoresUrl($search_city);
        }
        }
    }


    private function getStoresUrl($stores)
    {
        if(session('route_name') === 'shop') {
            foreach ($stores as $store) {
                $store->url = route('shop', [$store->slug, $this->direction_slug]);
            }
        }
        else if(session('route_name') === 'product.shop') {
            foreach ($stores as $store) {
                $store->url = route('shop', [$store->slug, $this->direction_slug]);
                #Отключил так как была ошибка при смене города и отсутствии такого товара в другом городе
//                $store->url = route('product.shop', [$store->slug, $this->direction_slug ,session('slug')]);
            }
        }
        else if(session('route_name') === 'product.details') {
            foreach ($stores as $store) {
                $store->url = route('shop', [$store->slug, $this->direction_slug]);
                #Отключил так как была ошибка при смене города и отсутствии такого товара в другом городе
//                $store->url = route('product.details', ['city_slug'=>$store->slug, 'slug' => session('slug')]);
            }
        }
        else {
            foreach ($stores as $store) {
                $store->url = session('url');
            }
        }
        return $stores;
    }

//  Определение города пользователя по ip адресу
    public function getLocation(Request $request){
        $ip = $request->ip();
//        $ip ='95.139.94.232';
//        $ip ='176.59.172.148';
//        $ip ='91.211.104.1';
//        $ip ='195.216.211.125';
//        dd($request->ip());
        if ($user_location = Location::get($ip)) {
            $this->user_location= $user_location->cityName;
//            dd($user_location->cityName);
            $store_city = Store::where('real_name', $user_location->cityName)->first();
            if($store_city)
            {
                $this->location_city = $store_city->real_name;
                $this->city_slug = $store_city->slug;
            }
            else {
                $this->location_city = 'Менделеево';
                $this->city_slug ='mendeleevo';
            }
        } else {
            $this->location_city = 'Менделеево';
            $this->city_slug ='mendeleevo';
        }
    }

    public function cookie()
    {
        session()->put('cookie', true);
        Cookie::queue('cookie', 'yes', 20160);
    }

    public function beta_test()
    {
        session()->put('beta_test', true);
        Cookie::queue('beta_test', 'yes', 20160);
//        return redirect('/');
//        $this->redirect('/');
//        dd(Cookie::get('beta_test'));
    }

    public function render(Request $request)
    {
        $this->getLocation($request);
        $this->user_ip = $request->ip();
        $query_stores = Store::where('status', 1)->orderBy('real_name', 'ASC')->get();

        if($query_stores)  $stores = $this->getStoresUrl($query_stores);

//        $store1 = session(Store::store_id());


//            return view('livewire.footer-component', compact('stores', 'store1'));
            return view('livewire.footer-component', compact('stores' ));

    }
}

