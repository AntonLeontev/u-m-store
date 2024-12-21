<?php

namespace App\Helpers\BlockChain;

use App\Helpers\BlockChain\UmtApi;
use App\Models\BlockChainTransactions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UmcApi
{
//    private static $blockchain_host = 'http://164.92.250.195:3000';
    private static $blockchain_host = 'http://68.183.78.141:3000';
    private static $UMT_DEPLOYER = '0x68fa5c1b0c4053751df55a36894310e6d689273b';
    private static $marketplace_address='0x659f81b3221f3f9dBFb73dAE082cb83eaB55FFDD';
    private static $one_UMC = 100000000; //Один umc токен в копейках


    //POST API
    public static function TxExecute($file_name, $signature)
    {

        //Проверяем наличие файла
        if (Storage::disk('blockchain')->exists('TX_FILE/' . $file_name)) {
            $response_arr = json_decode(Storage::disk('blockchain')->get('TX_FILE/' . $file_name));

            $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])->bodyFormat
            ('json')
                ->post(self::$blockchain_host . '/tx',
                    [
                        "req" => $response_arr,
                        "signature" => $signature
                    ]);
            //Сохраняем транзакцию в базу
            BlockChainTransactions::saveTransaction('POST',__FUNCTION__, $response->body(),$response->status());

            //Проверка статуса транзакции 10 попыток каждые 2 секунды и одна через 30 секунд.
            if (isset($response->json()['txId'])) {
                $status_count = 0;
                do {
                    sleep(2);
                    $status = UmtApi::GetTxStatus($response->json()['txId']);
                    //Задержка между попытками 2 секунды
                    $status_count++;
                } while($status['status'] == 'PENDING' and $status_count < 10);
                if($status['status'] == 'SUCCESS')
                {
                    return $status_count++;
                }
                else
                {
                    sleep('30');//Последняя попытка с задержкой 30 секунд
                    $status = UmtApi::GetTxStatus($response->json()['txId']);
                    return $status;
                }

            }
            else return false;


        } //Если файла нет
        else return false;
    }

    /**
     *Function send UMC to address
     *Функция отправки UMC токенов на указанный адрес
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function UMCTransfer($address, $amount)
    {

        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->post(self::$blockchain_host . '/token/umc/transfer',
                [
                    "amount" => self::$one_UMC * $amount,
                    "to" => $address
                ]);

        //Запись транзакции в базу
        BlockChainTransactions::saveTransaction('POST',__FUNCTION__, $response->body(),$response->status());


        //Сохранение ответа для подписи в файл.
        $file_name = __FUNCTION__ . '_' . time() . '_' . Str::random(4) . '.json';
        Storage::disk('blockchain')->put('TX_FILE/' . $file_name, $response->body());
        $signature = RunNodeJsScript::signMetaTx('../TX_FILE/' . $file_name);

        //Передача подписанной транзакции в блокчейн

//        $status = self::TxExecute($file_name, $signature);//ответ
        $status = UmtApi::TransactionSignatureAndSave($response, __FUNCTION__);//ответ



        //Удаляем файл после отправки
        Storage::disk('blockchain')->delete('TX_FILE/' . $file_name);
        return $status;
//
    }
    //GetMethods

    /**
     *Function get balances
     *Получить информацию о балансах всех инвест кошельков
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function UMCGetBalances()
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/token/umc/balances');
        $Transaction = new BlockChainTransactions;
        $Transaction->method = 'GET';
        $Transaction->function_api = __FUNCTION__;
        $Transaction->response_json = $response->body();
        $Transaction->status_code = $response->status();
        $Transaction->save();
        return $response->json();
    }

    /**
     *Function get balances
     *Получить информацию о балансах всех инвест кошельков
     *
     * @return json, array, string
     * @link
     *
     * @static
     *
     */
    public static function UMCGetBalance($address, $response_type = 'all')
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/token/umc/balances/' . $address);
        $Transaction = new BlockChainTransactions;
        $Transaction->method = 'GET';
        $Transaction->function_api = __FUNCTION__;
        $Transaction->response_json = $response->body();
        $Transaction->status_code = $response->status();
        $Transaction->save();
        if ($response_type == 'all') {
            return $response->body();
        } elseif ($response_type == 'balance') {
            return $response->json()['balance'] / 100000000;
        } else return $response->json();
    }

}
