<?php

namespace App\Helpers\BlockChain;

use App\Models\BlockChainTransactions;
use App\Models\ChainStatusTransaction;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Helper for interacting with the blockchain API
 * @author Garanskiy Artem
 * @copyright UMChain.org 2022
 * @version 1.0
 *
 *
 */
class UmtApi
{
//    private static $blockchain_host = 'http://164.92.250.195:3000';
    private static $blockchain_host = 'http://68.183.78.141:3000';
    #private static $UMT_DEPLOYER = '0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0';
    #private static $marketplace_address='0x3eD762137BB30E64579694c7b31aE3a5F7b6EF91';

    private static $UMT_DEPLOYER = '0x68fa5c1b0c4053751df55a36894310e6d689273b';
    private static $marketplace_address='0x659f81b3221f3f9dBFb73dAE082cb83eaB55FFDD';
    private static $one_umt = 100000000; //Один umt токен в копейках

    //Проверка json на валидность.
    public static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    //PUT
    /**
     *Function
     *Функция обновления наценки партнера.
     * @static
     * @param $address адрес кошелька продавца
     * @param $commission новая коммиссия продавца
     * @return array
     * @link
     */
    public static function MarketplaceUpdateSeller($address, $commission)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->put(self::$blockchain_host . '/marketplace/sellers/'.$address,
                [
                    "fee" => $commission * 10 ** 6,
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        $status = self::TransactionSignatureAndSave($response, __FUNCTION__);

        return $status;
    }

    //POST
    /**
     *Function
     *Функция подтверждения списания средств покупателя маркетплейсом.
     * @static
     * @return array
     * @link
     */
    public static function UMTApproveBuyerToMarketplace( $amount=10000, $buyer_address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => $buyer_address])
            ->post(self::$blockchain_host . '/token/umt/approve',
                [
                    "amount"=>$amount*self::$one_umt,
                    "spender"=>self::$marketplace_address,

                ]);

        //Подпись транзакции и сохранение в блокчейне.
        if ($wallet_info = UserWallet::returnWalletByAddress($buyer_address)) {

            $wallet_path = '../wallets/' . $wallet_info->wallet_file_name;

            //Расшифровуем пароль из базы
            $password = Crypt::decryptString($wallet_info->wallet_pass_hash);
            $status = self::TransactionSignatureAndSave($response, __FUNCTION__, $wallet_path, $password);
            return $status;

        } else return 'Wallet not found!';
    }
    public static function TxExecute($file_name, $signature, $function_name)
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
            BlockChainTransactions::saveTransaction('POST', __FUNCTION__, $response->body(), $response->status());
            set_time_limit(0);
            //Проверка статуса транзакции 10 попыток каждые 2 секунды и одна через 30 секунд.
            if (isset($response->json()['txId'])) {
                ChainStatusTransaction::saveTransaction($response_arr->from, $response->json()['txId'], $function_name, $response->body(), $status = 'CREATE');
                $status_count = 0;
                do {
                    sleep(2);//Задержка между попытками проверки статуса транзакции 2 секунды
                    $status = UmtApi::GetTxStatus($response->json()['txId']);
                    $status_count++;

                } while ($status['status'] == 'PENDING' and $status_count < 15 and $status['status'] != 'FAILURE');
                if ($status['status'] == 'SUCCESS') {
                    ChainStatusTransaction::saveGetTxStatus($response->json()['txId'], $status['status']);
                    return $status;
                }elseif ($status['status'] == 'FAILURE')
                {
                    $id = ChainStatusTransaction::saveGetTxStatus($response->json()['txId'], $status['status']);

                    Log::warning('Ошибка записи в блокчейн! id записи '.$id);

                    return $status;
                } elseif ($status['status'] == 'PENDING' and $function_name=='MarketplaceBuyProduct') {
                    sleep('600');//Последняя попытка с задержкой 600 секунд
                    $status = UmtApi::GetTxStatus($response->json()['txId']);
                    ChainStatusTransaction::saveGetTxStatus($response->json()['txId'], $status['status']);
                    return $status;
                } elseif ($status['status'] == 'PENDING') {
                    sleep('30');//Последняя попытка с задержкой 30 секунд
                    $status = UmtApi::GetTxStatus($response->json()['txId']);
                    ChainStatusTransaction::saveGetTxStatus($response->json()['txId'], $status['status']);
                    return $status;
                } else {
                   ChainStatusTransaction::saveGetTxStatus($response->json()['txId'], $status['status']);
                    return $status;
                }

            } else return $response->json();


        } //Если файла нет
        else return 'File tx.json not found';
    }
    /**
     *Function
     *Функция регистрации покупателя.
     * @static
     * @return array
     * @link
     */
    public static function MarketplaceBuyProduct($id , $amount, $buyer_address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => $buyer_address])
            ->post(self::$blockchain_host . '/marketplace/purchases',
                [
                    "id" => $id,
                    "amount" => $amount,
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        if ($wallet_info = UserWallet::returnWalletByAddress($buyer_address)) {

            $wallet_path = '../wallets/' . $wallet_info->wallet_file_name;

            //Расшифровуем пароль из базы
            $password = Crypt::decryptString($wallet_info->wallet_pass_hash);
            $status = self::TransactionSignatureAndSave($response, __FUNCTION__, $wallet_path, $password);
            return $status;

        } else return 'Wallet not found!';
    }
    /**
     *Function
     *Функция регистрации покупателя.
     * @static
     * @return array
     * @link
     */
    public static function MarketplaceRegisterBuyer($address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->post(self::$blockchain_host . '/marketplace/buyers',
                [
                    "identifier" => $address
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        $status = self::TransactionSignatureAndSave($response, __FUNCTION__);

        return $status;
    }

    /**
     *Function
     *Функция регистрации покупателя. Нужно передать адрес кошелька и комиссию.
     * @static
     * @return array
     * @link
     */
    public static function MarketplaceRegisterSeller($address, $commission)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->post(self::$blockchain_host . '/marketplace/sellers',
                [
                    "fee" => $commission * 10 ** 6,
                    "identifier" => $address
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        $status = self::TransactionSignatureAndSave($response, __FUNCTION__);

        return $status;
    }

    /**
     *Function
     *Функция создания продукта и регистрации его в блокчейн.
     * @static
     * @param $id - уникальный id продукта
     * @param $price - цена в рублях (umt)
     * @param $seller_address - адрес кошелька продавца
     * @return array
     * @link
     */
    public static function MarketplaceCreateProduct($id, $price, $seller_address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => $seller_address])
            ->post(self::$blockchain_host . '/marketplace/products',
                [
                    "id" => $id,
                    "price" => $price * 10 ** 8
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        if ($wallet_info = UserWallet::returnWalletByAddress($seller_address)) {

            $wallet_path = '../wallets/' . $wallet_info->wallet_file_name;

            //Расшифровуем пароль из базы
            $password = Crypt::decryptString($wallet_info->wallet_pass_hash);
            $status = self::TransactionSignatureAndSave($response, __FUNCTION__, $wallet_path, $password);
            return $status;

        } else return 'Wallet not found!';


        return $status;
    }

    /**
     *Function
     *Функция выпуск токенов UMT и перевод на указанный адрес
     * @static
     * @return array
     * @link
     */
    public static function UMTIssue($amount, $address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->post(self::$blockchain_host . '/token/umt/mint',
                [
                    "amount" => self::$one_umt * $amount,
                    "to" => $address
                ]);

        //Подпись транзакции и сохранение в блокчейне.
        $status = self::TransactionSignatureAndSave($response, __FUNCTION__);

        return $status;
    }
    /**
     *Function
     *Функция выпуск токенов UMT и перевод на указанный адрес
     * @static
     * @return array
     * @link
     */
    public static function UMTBurn($amount, $buyer_address)
    {
        $response = Http::withHeaders(['xx-blockchain-sender' => $buyer_address])
            ->post(self::$blockchain_host . '/token/umt/burn',
                [
                    "amount" => self::$one_umt * $amount,
                ]);
        if ($wallet_info = UserWallet::returnWalletByAddress($buyer_address)) {

            $wallet_path = '../wallets/' . $wallet_info->wallet_file_name;

            //Расшифровуем пароль из базы
            $password = Crypt::decryptString($wallet_info->wallet_pass_hash);
            $status = self::TransactionSignatureAndSave($response, __FUNCTION__, $wallet_path, $password);
            return $status;

        } else return 'Wallet not found!';
    }

    /**
     * Function save response to file and signature
     * Функция сохранения ответа сервера в файл для дальнейшей подписи и отправки транзакции в блокчейн.
     * @return array
     *
     * @link
     * @static
     */
    public static function TransactionSignatureAndSave($response, $function_name, $wallet_path = 'deployer.wallet.json', $password = '123')
    {
        //Если ответ валидный Json, то продолжаем выполнение.
        if (self::isJson($response->body())) {

            //Изменяем ставку на газ в json ответе
            $responseJson = $response->body();
            // $responseJson = json_decode($response->body());
            // $arr = json_decode($response);
//            $arr->gas = 400000;
            // $responseJson = json_encode($arr);
            //Сохраняем транзакцию в базу

            BlockChainTransactions::saveTransaction('POST', $function_name, $responseJson, $response->status());

            //Сохранение ответа для подписи в файл.
            $file_name = $function_name . '_' . time() . '_' . Str::random(4) . '.json';

            Storage::disk('blockchain')->put('TX_FILE/' . $file_name, $responseJson);

            //Запуск скрипта для подписи транзакции
            $signature = RunNodeJsScript::signMetaTx('../TX_FILE/' . $file_name, $wallet_path, $password);

            //Передача подписанной транзакции в блокчейн
            $status = self::TxExecute($file_name, $signature, $function_name);

            //Удаляем файл json после отправки
            Storage::disk('blockchain')->delete('TX_FILE/' . $file_name);

            //Возвращаем статус транзакции.
            return $status;
        } else {
            return $response->json();
        }
    }


    //GET METHODS

    /**
     *Функция получения информации о всех покупках
     * @return array
     * @static
     */
    public static function MarketplaceGetPurchases()
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/purchases');
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();
    }

    /**
     *Function get all buyers in blockchain
     *Функция получения информации о всех товарах
     * @return array
     * @static
     */
    public static function MarketplaceGetProduct($product_id)
    {

        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/products/' . $product_id);
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }

    /**
     *Function get all products in blockchain
     *Функция получения информации о всех товарах
     * @return array
     * @static
     */
    public static function MarketplaceGetProducts($page=1,$pageSize=10)
    {
        //Если есть параметры, то добавляем параметры к запросу
        if($page!=1 or $pageSize!=10) $param = '?page='.$page.'&pageSize='.$pageSize;
        else $param='';
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/products'.$param);
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }

    /**
     *Function get all buyers in blockchain
     *Функция получения информации о всех продавцах
     * @return array
     * @static
     */
    public static function MarketplaceGetSellers()
    {

        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/sellers');
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }
    /**
     *Function get all buyers in blockchain
     *Функция получения информации о всех продавцах
     * @return array
     * @static
     */
    public static function MarketplaceGetSeller($address)
    {

        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/sellers/'.$address);
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }

    /**
     *Function get all buyers in blockchain
     *Функция получения информации о всех покупателях
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function MarketPlaceGetBuyers()
    {

        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/buyers');
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }

    /**
     *Function get  buyer in blockchain by address
     *Функция получение информации о покупателе по его адресу
     *
     * @link https://documenter.getpostman.com/view/8228253/Uyr4Hyj2#3076ca26-c93c-4bb2-86e1-6e40e773f88b
     *
     * @static
     *
     * @return array
     */
    public static function MarketPlaceGetBuyer($address)
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/marketplace/buyers/' . $address);
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();

    }

    /**
     *Function get info about blockchain
     *Получить информацию о блокчейне
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function GetInfo()
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/info/blockchain');
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());

        return $response->json();
    }

    /**
     *Function get status transfer
     *Получить информацию о статусе транзакции
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function GetTxStatus($txId)
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/tx/' . $txId);

        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());
        return $response->json();
    }


    /**
     *Function get balances
     *Получить информацию о балансах всех кошельков
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function UMTGetBalances()
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/token/umt/balances');

        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());

        return $response->json();
    }

    /**
     *Function get balances
     *Получить информацию о балансе переданного кошелька
     *
     * @return array
     * @link
     *
     * @static
     *
     */
    public static function UMTGetBalance($address)
    {
        $response = Http::retry(2, 200)->withHeaders(['xx-blockchain-sender' => self::$UMT_DEPLOYER])
            ->get(self::$blockchain_host . '/token/umt/balances/' . $address);
        //Сохраняем транзакцию в базу
        BlockChainTransactions::saveTransaction('GET', __FUNCTION__, $response->body(), $response->status());

        return $response->json();
    }



}

