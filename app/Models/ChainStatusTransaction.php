<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChainStatusTransaction extends Model
{
    use HasFactory;
    //Создание записи транзакции в базе для дальнейшего отслеживания ее состояния
    public static function saveTransaction($wallet_address, $txId,$method_api, $response_body,$status='CREATE')
    {
        $StatusTransaction = new ChainStatusTransaction;
        $StatusTransaction->user_id = Auth::id() ;
        $StatusTransaction->status = $status;
        $StatusTransaction->wallet_address = $wallet_address;
        $StatusTransaction->txId = $txId;
        $StatusTransaction->method_api = $method_api;
        $StatusTransaction->response_json = $response_body;
        $StatusTransaction->save();
    }
    public static function saveGetTxStatus($txId,$status)
    {
        //При изменении статуса находим транзакции находим запись и сохраняем ее.
        $StatusTransaction = ChainStatusTransaction::firstWhere('txId',$txId);

        if($StatusTransaction)
        {
            $StatusTransaction->status = $status;
            $StatusTransaction->save();
            return $StatusTransaction->id;
        } else return false;

    }

}
