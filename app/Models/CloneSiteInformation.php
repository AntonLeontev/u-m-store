<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloneSiteInformation extends Model
{
    use HasFactory;

    protected $table = 'clone_site_information';
    protected $guarded = ['id'];

    public static function getInfo()
    {
        #Если есть такой домен в базе вернуть массив информации об этом домене и сохранить в сессию.
        if ($clone_info = CloneSiteInformation::firstWhere('domain', session()->get('domain'))) {
            $clone_info_arr = [
                'city_slug' => Store::find($clone_info->store_id)?->slug,
                'direction_slug' => Directions::find($clone_info->direction_id)->slug,
                'city_name' => $clone_info->city_name,
                'partner_id' => $clone_info->partner_id,
                'store_id' => $clone_info->store_id,
                'direction_id' => $clone_info->direction_id,
                'logo' => $clone_info->logo,
                'company_name' => $clone_info->company_name,
                'phone' => $clone_info->phone,
                'email' => $clone_info->email,
                'address' => $clone_info->address,
                'inst_link' => $clone_info->inst_link,
                'vk_link' => $clone_info->vk_link,
                'fb_link' => $clone_info->fb_link,
                'youtube_link' => $clone_info->youtube_link,
                'telegram_link' => $clone_info->telegram_link,
                'margin' => $clone_info->margin,
                'year' => date('Y')

            ];
            session()->put('clone_info', $clone_info_arr);
            session()->put('city', ['name' => $clone_info_arr['city_name'], 'slug' => $clone_info_arr['city_slug']]);
            return $clone_info_arr;
        } else {
            return false;
        }
    }
}
