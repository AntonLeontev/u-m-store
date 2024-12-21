<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function SaveWallet($Wallet_name, $password_hash)
    {

    }
    public static function returnWalletByUserId($id)
    {
        return UserWallet::firstWhere('user_id',$id);
    }
    public static function returnWalletByAddress($address)
    {
        if ($user_wallet = UserWallet::firstWhere('wallet_address',$address))
        {
            return $user_wallet;
        } else return false;

    }
}
