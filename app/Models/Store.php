<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $guarded = ['id'];
    public static function store()
    {
//    session()->forget('city');
        if(session()->has('city'))
        {
            $store = Store::where('real_name', session('city')['name'])->first();
            if($store)
            {
                return $store;
            }
            else
            {
                session()->put('city', ['name' => 'Менделеево', 'slug' => 'mendeleevo'] );
                return Store::where('real_name', 'Менделеево')->first();
            }
        }
        else
        {
            session()->put('city', ['name' => 'Менделеево', 'slug' => 'mendeleevo']);
            session()->put('needCity', true);
            return Store::where('real_name', 'Менделеево')->first();
        }

    }

    public static function store_id()
    {

//        if(isset(session('city')['name']) && Store::firstWhere('real_name', session('city')['name']))
        if(isset(session('city')['name']))
        {
            if(session()->has('city_id'))
            {
                return session('city_id');
            }
            else
            {
                $city_id = Store::firstWhere('real_name', session('city')['name'])?->id;
                session()->put('city_id');
                return $city_id;
            }


        }
        else
        {
            return Store::firstWhere('real_name', 'Менделеево')->id;
        }

    }



    public function store_products()
    {
        return $this->hasMany(Product_to_store::class);
    }




}
