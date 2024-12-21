<?php

namespace App\Helpers\BlockChain;

use App\Jobs\ChainApi\MarketplaceRegisterBuyer;
use App\Models\BlockChainTransactions;
use App\Models\UserWallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class RunNodeJsScript
{
    public static function runNodeJsScript($command)
    {
        if (App::environment('testApi')) {

            return shell_exec('cd ../storage/app/blockchain/scripts/ && ' . $command);
        } else {
            return shell_exec('cd '. storage_path().'/app/blockchain/scripts/ && ' . $command);
        }

    }

    /**
     * Генерирует новый кошелек
     * Нужно передать в качестве параметра пароль на кошелек
     * @param string $fw_address адрес форвардера
     *
     * Возвращает название файла после его генерации.
     * @return string file name.
     */
    public static function signMetaTx($tx_file, $wallet_path = 'deployer.wallet.json', $password = '123', $fw_address = '0x81567402Ed1504B2aa0aCEb02D7887e1C97B1f24', $chain_id = '137')
    {

        //Формируем команду для выполнения
        $command = 'FORWARDER_ADDRESS=' . $fw_address . ' CHAIN_ID=' . $chain_id . ' WALLET_PATH=' . $wallet_path . ' WALLET_PASSWORD=' . $password . ' TX_PATH=' . $tx_file . ' node signMetaTx.js';

        //Запуск команды
        $out = self::runNodeJsScript($command);
        $signMeta = explode(PHP_EOL, $out)[1];//Получает подпись

        BlockChainTransactions::saveTransaction('NodeJs_signMeta', __FUNCTION__, json_encode($signMeta), 0);

        //Отправляем на подпись транзакцию

        return $signMeta;
    }

    /**
     * Генерирует новый кошелек
     * Нужно передать в качестве параметра пароль на кошелек
     * @param string
     *
     * Возвращает адрес кошелька после его генерации.
     * @return string file name.
     */

    public static function generateWallet($password_for_wallet, $auth_user=false)
    {

        //Сравниваем пароль введенный пароль с хешем в базе.
        //Если совпадают, то создаем кошелек с паролем от учетной записи.
        if (Hash::check($password_for_wallet, $auth_user->password)|| true) {

            //Получаем название папки, для хранения ключей, в виде месяц_год.
            $folder_name = Carbon::now()->format('Y_m');
            echo $folder_name;
            //Формируем команду для генерации кошелька.
            $command = 'WALLET_PASSWORD=' . $password_for_wallet . ' FOLDER_NAME=' . $folder_name . ' node generateWallet.js';

            $out = self::runNodeJsScript($command);

            //Получить строки вывода скрипта. 1я строка путь к файлу, 2я адрес кошелька.
            $out = explode(PHP_EOL, $out);

            if (count($out) == 3) {

                //Записываем данные кошелька в базу данных
                $result = UserWallet::create([
                    'user_id' => $auth_user->id,
                    'wallet_type' => $auth_user->partner_id ? 'seller' : 'buyer',
                    'wallet_address' => $out[1],
                    'wallet_file_name' => $out[0],
                    'wallet_pass_hash' => Crypt::encryptString($password_for_wallet)//Запись в базу зашифрованного
                    // пароля от кошелька.
                ]);
                //Зарегистрированному кошельку добавляем статус покупателя
                MarketplaceRegisterBuyer::dispatch($out[1]);
                return $out[1];
            } else return false;
        } else   return 'The password does not match your account password.';
    }
}
