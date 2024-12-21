<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockChainTransactions extends Model
{
    use HasFactory;
    public static function saveTransaction($method,$function_name, $response_body,$status)
    {

        $Transaction = new BlockChainTransactions;
        $Transaction->method = $method ;
        $Transaction->function_api = $function_name;
        $Transaction->response_json = $response_body;
        $Transaction->status_code = $status;
        $Transaction->save();
    }
}
