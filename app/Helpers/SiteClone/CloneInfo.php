<?php

namespace App\Helpers\SiteClone;

use App\Models\CloneSiteInformation;

class CloneInfo
{
    public static function getParnterId()
    {
        if (session()->has('clone_info')) {
            $partner_id = session('clone_info')['partner_id'];
        } else {
            $partner_id = CloneSiteInformation::getInfo()['partner_id'];
        }
        return $partner_id;
    }
}
