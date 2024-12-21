#Методы API для взаимодействия со смарт-контрактом
## Методы GET

###UmtApi::GetInfo - информация о смарт-контракте.
  + Запрос
    ```
      http://{{HOST}}/info/blockchain
    ```
  + Пример ответа
    ```
    {
      "chainId": 80001,
      "contracts": {
        "umcToken": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df",
        "umtToken": "0x148860BD5Ec31BE8482Ef14d9ae96F38aA00fDe7",
        "forwarder": "0x49da1d521Ed06CBD0D981f78E5C37886071C2D94",
        "marketplace": "0x3eD762137BB30E64579694c7b31aE3a5F7b6EF91"
       }
    }
    ```
***
  
###UmtApi::GetTxStatus - получить статус транзакции в блокчейне.
+ Запрос
     ```
    http://{{HOST}}/tx/0x176338e4f363bb844a52f48db8d54b7f25566831802cd70d729420f2171fecd4
    ```
+ Ответ 
    ```
    {
    "status": "SUCCESS",
    "blockHash": "0xb1e13dc19b0cf22fe5a3505b30052f9e5117a3e3153b1d120ad1d9e1acf7acab",
    "transactionHash": "0x176338e4f363bb844a52f48db8d54b7f25566831802cd70d729420f2171fecd4"
    }
    ```
  - возможные статусы 
    - PENDING - в ожидании
    - SUCCESS - успешная транзакция.
*** 
###UmcApi::UMCGetBalances() - получить все балансы umc кошельков.
+ Запрос
   ```
    http://{{HOST}}/token/iumt/balances
  ```
+ Ответ
  
  ```
  {
    "page": 1,
    "pageSize": 10,
    "totalPages": 1,
    "data": [
        {
            "address": "0x6ac859Ae5F6d1d5d79a80F62A932C4adc48A02D0",
            "tokenAddress": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df",
            "balance": "44400000012345678"
        }
    ]
  }
  ```
***  
###UmcApi::UMCGetBalance($address) - получить баланс конкретного кошелька.
+ Запрос
    ```
    http://{{HOST}}/token/iumt/balances/{{address}}
    ```
+ Ответ
  ```
  {
    "address": "0x13ba774E7F4Aabc8De51Cc1c46C8Cae29baaF146",
    "balance": "101000000000",
    "tokenAddress": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df"
  }
  ```
***   
###UMCGetBalances - 
+ Запрос
  ```
  http://{{HOST}}/token/umc/balances
  ```
+ Ответ
  
    ```
    {
    "data": [
        {
            "address": "0x6ac859Ae5F6d1d5d79a80F62A932C4adc48A02D0",
            "balance": "44399898912345678",
            "tokenAddress": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df"
        },
        {
            "address": "0x13ba774E7F4Aabc8De51Cc1c46C8Cae29baaF146",
            "balance": "101100000000",
            "tokenAddress": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df"
        }
    ],
    "page": 1,
    "pageSize": 10,
    "totalPages": 1
  }
   ```
***  
###UmtApi::UMTGetBalance($address) - получить баланс кошелька umt по адресу
+ Запрос
  + 
    ```
    http://{{HOST}}/token/umt/balances/{{UMT_BUYER}}
    ```
+ Ответ
  ```
  {
    "address": "0x4707E201e170026e16078A7d485E6b19C1508e0e",
    "balance": "1000000000",
    "tokenAddress": "0x148860BD5Ec31BE8482Ef14d9ae96F38aA00fDe7"
  }
  ```
***   
###UmtApi::MarketplaceGetSellers() - получить всех продавцов.

+ Запрос
  ```
  http://{{HOST}}/marketplace/sellers
  ```

+ Ответ
  ```
  
  ```

***  
###UmtApi::MarketplaceGetSeller($address) - получить информации по кошельку продавца
+ Запрос
  ```
  http://{{HOST}}/marketplace/sellers/{{UMT_SELLER}}
  ```

+ Ответ
  ```
  
  ```

***   
###UmtApi::MarketplaceGetBuyers() - получить всех покупателей.
+ Запрос
   ```
   http://{{HOST}}/marketplace/buyers
   ```
+ Ответ  
    ```
    {
      "data": [
        {
            "address": "0x4707E201e170026e16078A7d485E6b19C1508e0e",
            "enabled": true,
            "transactionHash": "0xfa9a985127cafb2c35b8cd4593456ffd6137fd362e5f4ba0953cbef97af557a3"
        },
        {
            "address": "0xb5ad7f6D3b331f912528B40B468C9eE710ef208e",
            "enabled": true,
            "transactionHash": "0x13afbb739809e37fd4cca736feef646a1bd09922bfeb065b4e6e6de0ed428ba4"
        }
      ],
      "page": 1,
      "pageSize": 10,
      "totalPages": 1
    }
    ```
***  
###UmtApi::MarketplaceGetBuyer($address) - получить информацию о покупателе по адресу.
+ Запрос
   ```
    http://{{HOST}}/marketplace/buyers/{{UMT_BUYER}}
   ```
+ Ответ
   ```
   {
     "address": "0x4707E201e170026e16078A7d485E6b19C1508e0e",
     "enabled": true,
     "transactionHash": "0xfa9a985127cafb2c35b8cd4593456ffd6137fd362e5f4ba0953cbef97af557a3"
   }

   ```
***   
###MarketplaceGetProducts
+ Запрос
    ```
    http://{{HOST}}/marketplace/buyers/{{UMT_BUYER}}
    ```
+ Ответ
    ```
    
    ```
***  
###MarketplaceGetProduct
+ Запрос
  ```
  
  ```

+ Ответ
  ```
  
  ```
   
###MarketplaceGetPurchases
+ Запрос
  ```
  
  ```

+ Ответ
  ```
  
  ```
***

## Методы POST

- Все запросы должны содержать заголовок umt_deployer (адрес кошелька umt_deployer) 
  - HEADERS
    XX-Blockchain-Sender
    {{UMT_DEPLOYER}}
###POST UmtApi::TxExecute($file_json, $signature) - отправить подписанную транзакцию в блокчейн.
- Внутри метода реализована проверка статуса txId методом UmtApi::GetTxStatus.
- И возврат этого статуса в случае успеха. И false если не был получен txId. 
+ Запрос 
  ```
  http://{{HOST}}/tx  
  ```
+ BODY Raw
    ```
    {
    "req": {
        "from": "{{TX_RESPONSE_FROM}}",
        "to": "{{TX_RESPONSE_TO}}",
        "value": {{TX_RESPONSE_VALUE}},
        "gas": {{TX_RESPONSE_GAS}},
        "nonce": {{TX_RESPONSE_NONCE}},
        "data": "{{TX_RESPONSE_DATA}}"
    },
       "signature": "0xf7e9b9e49deee5fe5c0332f487d5fb611733dd2c893a85ec31ed950ff60e82f2001dc970a5dd4fe3f307ee17ed702406abdd1a66449934ed751caa90a36443961c"
    }

    ```

+ Ответ
  ```
  {
    "txId": "0xc334bd0d90c9be8c935c0afcc2293fcb92497d6aaedae182f79b18ad14e33014"
  }
  ```
***
###POST UmtApi::UMCTransfer($address, amount) - перевод внешних токенов umc на кошелек. 
   
- $address - адрес получателя
- $amount - количество токенов.

+ Запрос 
  ```
  http://{{HOST}}/token/umc/transfer
  ```
+ BODY Raw
  ```
  {
    "amount": 100000,
    "to": "0x822590a618788310A1CfDe8Da1C121144281EE44"
  }
  
  ```

+ Ответ
  ```
  {
    "to": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df",
    "gas": 300000,
    "data": "0xa9059cbb00000000000000000000000013ba774e7f4aabc8de51cc1c46c8cae29baaf1460000000000000000000000000000000000000000000000000000000005f5e100",
    "from": "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0",
    "nonce": "15",
    "value": 0
  }
  ```
 - После получения ответа вызывается функция RunNodeJsScript::signMetaTx для подписи транзакции. 
 - Потом вызывается функция UmtApi::TxExecute для передачи операции в блокчейн.
   - Метод получает txId идентификатор транзакции.
   - Проверяет статус транзакции (UmtApi::GetTxStatus) и возвращает статус после нескольких попыток. 
   
***
###POST UmtApi::UMTIssue($amount, $address) - выпуск токенов umt
- $amount - количество токенов.
- $address - адрес получателя


+ Запрос
  ```
  http://{{HOST}}/token/umt/mint
  ```
+ BODY Raw
  ```
  {
    "amount": 100000,
    "to": "0x822590a618788310A1CfDe8Da1C121144281EE44"
  }
  
  ```

+ Ответ
  ```
  {
    "to": "0x1696D0Ea00F0EaE76912dBd00371367a9F3bD5Df",
    "gas": 300000,
    "data": "0xa9059cbb00000000000000000000000013ba774e7f4aabc8de51cc1c46c8cae29baaf1460000000000000000000000000000000000000000000000000000000005f5e100",
    "from": "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0",
    "nonce": "15",
    "value": 0
  }
  ```
- ответ сохраняется в файл json для подписи.
- После получения ответа вызывается функция RunNodeJsScript::signMetaTx для подписи транзакции.
- Потом вызывается функция UmtApi::TxExecute для передачи подписанной операции в блокчейн.
    - Метод получает txId идентификатор транзакции.
    - Проверяет статус транзакции (UmtApi::GetTxStatus) и возвращает статус после нескольких попыток.
***
###POST UmtApi::UMTBurn() - сжигание токенов
+ Запрос 
  ```
  
  ```

+ Ответ
  ```
  
  ```
***
###POST UmtApi::UMTApproveBuyerToMarketplace() - подтверждение распоряжаться токенами
+ Запрос
  ```
  
  ```

+ Ответ
  ```
  
  ```
***
###POST UmtApi::MarketplaceRegisterSeller($address, $commission) - регистрация продавца.
  - $address - адрес продавца
  - $commission - комиссия которую мы берем с продавца. Передать нужно в виде числа.
    - Пример 12.5 или 10 и т.п. В функции умножение на 10^6.
    
+ Запрос
  ```
  http://{{HOST}}/marketplace/sellers
  ```
+ BODY Raw
  ```
  {
    "fee": 12000000,
    "identifier": "{{UMT_SELLER}}"
  }
  
  ```
   - "fee" - комиссия которую мы берем с продавца (12 процентов.) 
   - "identifier" - адрес кошелька продавца.

+ Ответ
  ```
  {
    "to": "0x3eD762137BB30E64579694c7b31aE3a5F7b6EF91",
    "gas": 300000,
    "data": "0xa29342c10000000000000000000000004707e201e170026e16078a7d485e6b19c1508e0e0000000000000000000000000000000000000000000000000000000000b71b00",
    "from": "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0",
    "nonce": "26",
    "value": 0
  }
  ```
    - ответ сохраняется в файл json для подписи.
- После получения ответа вызывается функция RunNodeJsScript::signMetaTx для подписи транзакции.
- Потом вызывается функция UmtApi::TxExecute для передачи подписанной операции в блокчейн.
    - Метод получает txId идентификатор транзакции.
    - Проверяет статус транзакции (UmtApi::GetTxStatus) и возвращает статус после нескольких попыток.
***
###POST UmtApi::MarketplaceRegisterBuyer() - 
+ Запрос
  ```
  http://{{HOST}}/marketplace/sellers
  ```
+ BODY Raw
  ```
  {
     "identifier": "{{UMT_SELLER}}"
  }
  
  ```
    - "identifier" - адрес кошелька покупателя.

+ Ответ
  ```
  {
    "to": "0x3eD762137BB30E64579694c7b31aE3a5F7b6EF91",
    "gas": 300000,
    "data": "0xa29342c10000000000000000000000004707e201e170026e16078a7d485e6b19c1508e0e0000000000000000000000000000000000000000000000000000000000b71b00",
    "from": "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0",
    "nonce": "26",
    "value": 0
  }
  ```
    - ответ сохраняется в файл json для подписи.
- После получения ответа вызывается функция RunNodeJsScript::signMetaTx для подписи транзакции.
- Потом вызывается функция UmtApi::TxExecute для передачи подписанной операции в блокчейн.
    - Метод получает txId идентификатор транзакции.
    - Проверяет статус транзакции (UmtApi::GetTxStatus) и возвращает статус после нескольких попыток.
***
###POST UmtApi::MarketplaceCreateProduct() - 
+ Запрос
  ```
  http://{{HOST}}/marketplace/sellers
  ```
+ BODY Raw
  ```
  {
    "id": 1,
    "price": 100000000
  }
  
  ```
    - "id" - id продукта.
    - "price" - цена.

+ Ответ
  ```
  {
    "to": "0x3eD762137BB30E64579694c7b31aE3a5F7b6EF91",
    "gas": 300000,
    "data": "0xa29342c10000000000000000000000004707e201e170026e16078a7d485e6b19c1508e0e0000000000000000000000000000000000000000000000000000000000b71b00",
    "from": "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0",
    "nonce": "26",
    "value": 0
  }
  ```
    - ответ сохраняется в файл json для подписи.
- После получения ответа вызывается функция RunNodeJsScript::signMetaTx для подписи транзакции.
- Потом вызывается функция UmtApi::TxExecute для передачи подписанной операции в блокчейн.
    - Метод получает txId идентификатор транзакции.
    - Проверяет статус транзакции (UmtApi::GetTxStatus) и возвращает статус после нескольких попыток.
***
###POST UmtApi::MarketplaceBuyProduct() - 
+ Запрос
  ```
  
  ```

+ Ответ
  ```
  
  ```
***
## Методы PUT
###PUT MarketplaceUpdateSeller
###PUT Marketplace UpdateProduct
###PUT EnqueueTx


