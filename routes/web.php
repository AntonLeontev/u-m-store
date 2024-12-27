<?php

use App\Helpers\BlockChain\RunNodeJsScript;
use App\Helpers\BlockChain\UmcApi;
use App\Helpers\BlockChain\UmtApi;
use App\Http\Controllers\auth\VerificationController;
#For Partner
use App\Http\Controllers\Feed\GetOrdersController;
use App\Http\Controllers\FileLockController;
use App\Http\Controllers\MailController\MailController;
use App\Http\Controllers\Payment\YookassaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Voyager\ProductsController;
use App\Http\Livewire\Admin\AdminAccountingComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;

use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminOrdersComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSettingsComponent;
use App\Http\Livewire\Admin\CloneWebSite\SiteClonePromotionSettings;
use App\Http\Livewire\Admin\CloneWebSite\SiteCloneSeoSetting;
use App\Http\Livewire\Admin\CloneWebSite\SiteCloneSettingsComponent;
use App\Http\Livewire\Admin\CloneWebSite\SiteCloneShopBottomSliderSettings;
use App\Http\Livewire\Admin\CloneWebSite\SiteCloneShopSliderSettings;
use App\Http\Livewire\Admin\PartnerFormRegistrationComponent;
use App\Http\Livewire\Admin\WalletComponent;
use App\Http\Livewire\AdminManager\AddCityComponent;
use App\Http\Livewire\AuthByCall;
use App\Http\Livewire\AuthComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\ForClone\Info\CloneOplata;
use App\Http\Livewire\ForClone\Info\ClonePolitikaKonfidencialnosti;
use App\Http\Livewire\ForClone\Info\ClonePolzovatelskoeSoglashenie;
use App\Http\Livewire\ForDev\TestApiBlockchain;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Info\CooperationComponent;
use App\Http\Livewire\Info\CooperrationNoOption;
use App\Http\Livewire\InformationComponent;
use App\Http\Livewire\InstructionForManagersComponent;
use App\Http\Livewire\Investor\InvestorLandingPage;
use App\Http\Livewire\NoPartnerComponent;
use App\Http\Livewire\Partner\FormUpdateDataForContract;
use App\Http\Livewire\Partner\FranchiseSaleAprile;
use App\Http\Livewire\Partner\FranchiseSaleComponet;
use App\Http\Livewire\PromotionsComponent;
use App\Http\Livewire\PWA\OfflineComponent;

use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\SEO\SiteMapComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\SuccessComponent;

use App\Http\Livewire\Telegram\SendError500Component;
use App\Http\Livewire\User\UserBonusComponent;
use App\Http\Livewire\User\UserCreateShopComponent;

// For manager
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserDeliveryComponent;
use App\Http\Livewire\User\UserNotificationsComponent;
use App\Http\Livewire\User\UserOrdersHistoryComponent;

//For SiteClone
use App\Http\Livewire\User\UserPromoComponent;
use App\Http\Livewire\User\UserReferralComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\User\UserSettingsComponent;
use App\Http\Livewire\WishlistComponent;
use App\Jobs\ChainApi\generateWallet;

//For new INFO
use App\Jobs\ChainApi\MarketplaceBuyProduct;
use App\Jobs\ChainApi\MarketplaceCreateProduct;
//For Auth
use App\Jobs\ChainApi\MarketplaceRegisterBuyer;
//Blockchain
use App\Jobs\ChainApi\UMTApproveBuyerToMarketplace;
use App\Jobs\ChainApi\UMTIssue;
use App\Models\ChainStatusTransaction;
use App\Models\User;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use TCG\Voyager\Facades\Voyager;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/test_api_blockchain', TestApiBlockchain::class)->name('test.api');
Route::get('/sent_umc', function (){
//    dd(UmcApi::UMCTransfer('0x1c72ed417DCd989DEDD4a196C798B50077fB1c2c', 100));
//    generateWalletdd(Auth::user());
});
Route::get('/test_polygon_request', function (){
    dd('response',UmtApi::MarketplaceRegisterBuyer('0x847EEec0e0a5CA9672baac3aFe78ea3843E89FC6'));
//    generateWalletdd(Auth::user());
});

Route::get('/blockchaintest', function () {
    $arr = json_decode('{"from":"0x68fa5c1b0c4053751df55a36894310e6d689273b","to":"0x659f81b3221f3f9dBFb73dAE082cb83eaB55FFDD","value":0,"gas":300000,"nonce":"0","data":"0xb9281d35000000000000000000000000b1739d2c949f7c25c6cc666a91613fd0e241be8e"}');
    $arr->gas = 350000;
    $arr = json_encode($arr);
        dd($arr);
    return dd('Информация о форвардере', UmtApi::GetInfo());

    return dd('Получение всех покупателей',UmtApi::MarketPlaceGetBuyers());
//    return dd('Получение всех продавцов',UmtApi::MarketplaceGetSellers());
//    return dd('Получение балансов кошельков',UmtApi::UMTGetBalances());
//    return dd('Получение продуктов', UmtApi::MarketplaceGetProducts(1,30));

    //    return dd('Зачисление токенов на кошелек', UmtApi::UMTIssue(50000, "0xf9731e398F0168FD612BC69c16cb49b88F154299"));
//    return dd(UmtApi::UMTIssue(1,'0x71187d557212d00a3F3dcb1639F5a31C54281e75'));
//    return dd('Подтверждение списания', UmtApi::UMTApproveBuyerToMarketplace(100000,'0x7470F291Ccf3a4D4c1153780bF7CfF5D4fa41950'));
//    return dd('Покупка товара',UmtApi::MarketplaceBuyProduct(13184, 1, '0x7470F291Ccf3a4D4c1153780bF7CfF5D4fa41950'));
//    return  dd('Подтверждение списания с кошелька покупателя', UmtApi::UMTApproveBuyerToMarketplace(100000,'0xf9731e398F0168FD612BC69c16cb49b88F154299'));
//    return dd('Получение балансов кошельков',UmtApi::UMTGetBalances());

//    return dd('Получение продаж', UmtApi::MarketplaceGetPurchases());
//    return dd('Продажа товара', UmtApi::MarketplaceBuyProduct(13184, 1, "0xf9731e398F0168FD612BC69c16cb49b88F154299"));
//    return dd('Зачисление токенов на кошелек', UmtApi::UMTIssue(50000, "0xf9731e398F0168FD612BC69c16cb49b88F154299"));
//    return dd(UmtApi::UMTGetBalances());
    //Запуск цепочки очередей.
//    Bus::chain([
//        new UMTApproveBuyerToMarketplace(10000,'0x7470F291Ccf3a4D4c1153780bF7CfF5D4fa41950'),
//        new UMTIssue(1250,"0x7470F291Ccf3a4D4c1153780bF7CfF5D4fa41950"),
//        new MarketplaceBuyProduct(1, 1, "0x7470F291Ccf3a4D4c1153780bF7CfF5D4fa41950")
//    ])->dispatch();
//    return 'Запустили очереди';
//    return 'Запуск очереди.';
//    return dd(UmtApi::getInfo());
//    return UmtApi::MarketplaceBuyProduct(10, 1, );

//    \App\Jobs\ChainApi\UMTBurn::dispatch(23625,'0x3BBaaF449332F33c912Efc6eBCCf1d7a64D0FC61');


//    return dd(UmtApi::UMTApproveBuyerToMarketplace(50000,'0x3BBaaF449332F33c912Efc6eBCCf1d7a64D0FC61'));
//    UmtApi::UMTIssue(11625,'0x3BBaaF449332F33c912Efc6eBCCf1d7a64D0FC61');
//   RunNodeJsScript::runNodeJsScript('ls');
//    return dd(Storage::disk('local_app')->path('scripts'));
//       ->pathPrefix);
//        \App\Jobs\ChainApi\MarketplaceRegisterSeller::dispatch('0xA8E7dE2f02e6fe551BDB1A50d1C4Aca93D5A27df',25);
//    return dd(UmtApi::GetTxStatus('0xe59c25bc8f356306a12caf926ee5fcec9632f60601eeeff2407312628d35ce11'));
//    Auth::user()->password;

//    return Auth::user()->password;
    \App\Jobs\ChainApi\MarketplaceRegisterSeller::dispatch('0x739F738D8510aAD9fa08A982175F4CB0900562f3',15);
//    generateWallet::dispatch(11111111, Auth::user());
//    return dd(UmtApi::MarketplaceUpdateSeller('0xA8E7dE2f02e6fe551BDB1A50d1C4Aca93D5A27df',35));
//    return dd(UmtApi::MarketPlaceGetBuyers());
//    return dd(UmtApi::MarketplaceGetSellers());
//    return dd(UmtApi::MarketplaceBuyProduct(2, 2, '0x4707E201e170026e16078A7d485E6b19C1508e0e'));
//    MarketplaceCreateProduct::dispatch(26, 1450, '0xa785a4DEcc7DFc7c5F529D63CE48194ED795973C');
//    \App\Jobs\ChainApi\MarketplaceBuyProduct::dispatch(2, 2, '0x4707E201e170026e16078A7d485E6b19C1508e0e');
//    ChainStatusTransaction::saveGetTxStatus('0x1749063d99e7b7068e4e3934395e756b0df812a358a4e05561964f75fb1b3017', 'test');
//    return dd(UmtApi::MarketplaceCreateProduct(30, 1850, '0xa785a4DEcc7DFc7c5F529D63CE48194ED795973C'));
//    return dd(UmtApi::MarketplaceRegisterBuyer('0xf39a2194bf774bab9be047a4b27e9f36f22d860c'));
    return 'Очередь запущена 19.';
//    $output = RunNodeJsScript::generateWallet(11111111);
//        return "<pre>$output</pre>";
//    return dd(UmtApi::UMTIssue(100, '0xf39a2194bf774bab9be047a4b27e9f36f22d860c'));
//    return dd(UmcApi::UMCTransfer('0x21041116A9a825400fD9c55b58543A247E7Ece57', 100));
//    return dd(UmcApi::UMCGetBalance('0x4707E201e170026e16078A7d485E6b19C1508e0e'));

//    return dd(UmtApi::MarketplaceGetProduct(1), 'MarketplaceGetProduct()');
//    return dd(UmtApi::UMTGetBalance('0xf39a2194bf774bab9be047a4b27e9f36f22d860c'));
//    return dd(UmtApi::MarketplaceGetSellers(), 'MarketplaceGetSellers');
//    return dd(UmtApi::MarketplaceRegisterSeller('0xa785a4DEcc7DFc7c5F529D63CE48194ED795973C', 12));

//    return dd(UmtApi::MarketPlaceGetBuyer('0x4707E201e170026e16078A7d485E6b19C1508e0e'));


//    return dd(BlockChainApi::IUMTGetBalance('0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0'));
//    return dd(UmtApi::IUMTGetBalance('0x13ba774E7F4Aabc8De51Cc1c46C8Cae29baaF146'));
//    return dd(BlockChainApi::TxExecuteJson());
//    $output = shell_exec('C:\Program Files\Git\bin\bash.exe "ls -a"');
//    $output = getcwd();
//    $output = shell_exec('cd ../storage/app/key/blockchain/scripts/ && bash -c "ls" ');

//    $output = RunNodeJsScript::signMetaTx('/home/vagrant/united-market/storage/app/blockchain/TX_FILE/UMCTransfer_1651237142_FVxy.json');
//    $output = shell_exec('dir');
//
//    $from = "0x6ac859ae5f6d1d5d79a80f62a932c4adc48a02d0";
//    $to = "0x148860BD5Ec31BE8482Ef14d9ae96F38aA00fDe7";
//    $nonce = "0";
//    $data = "0x40c10f190000000000000000000000004707e201e170026e16078a7d485e6b19c1508e0e000000000000000000000000000000000000000000000000000000003b9aca00";
//    $bayer = '0xb5ad7f6d3b331f912528b40b468c9ee710ef208e';
//    $signature='0xf00d64bfdb215dba26abef4cf8e7559937522ab03a1f2c5d2ccf9a1d6282aef7254ce658c5c0ced9f5b9c9daa1d4f6b7ef94a2e63d75f5203a4a52682b0737731b';
//    $txId='0x4b57fb77261d36122c053299a330c3584b7432fe62733891c7d0457e61705266';
//    $saller = '';
//    $address ='0xb5ad7f6d3b331f912528b40b468c9ee710ef208e';
//    return dd(UmtApi::GetTxStatus($txId));
//    return 'fdfdf';
//    return dd(BlockChainApi::MarketplaceGetBuyers());

//    return dd(BlockChainApi::UmtGetBalance("0xb5ad7f6D3b331f912528B40B468C9eE710ef208e" ));
//    return dd(BlockChainApi::UmtIssue(1000000000,$bayer));
//    return time();
//    return dd(BlockChainApi::MarketplaceRegisterBuyer($address));
//    return dd(UmtApi::TxExecuteJson('UMCTransfer1651232451.json',$signature));
//    return dd(BlockChainApi::TxExecute($from,$to,$nonce,$data,$signature));
    //Get
//    return dd(UmtApi::GetTxStatus($txId));
//    return dd(BlockChainApi::GetInfo());
//    return dd(BlockChainApi::UMTGetBalances());

});
//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/generate_id', function () {
//
//    $users = User::all();
//    foreach ($users as $key => $user) {
////        dd($user->telegram_id, is_numeric($user->telegram_id));
//
//
//        do {
//            $hash = \Illuminate\Support\Str::random('25');
//
//        } while(User::firstWhere('telegram_id',$hash));
//            $user->telegram_id = $hash;
//            $user->save();
//
//    }
//});


/**
 * Роуты для телеграм ботов
 */
//Установка вебхука для телеграм бота UMSend
//Route::get('/setwebhook-umsend', function () {
//    $response = Telegram::bot('UMSend')
//        ->setWebhook(['url' => 'https://unitedmarket.org/fdmafqc1fq1qaz8yttgfsq2t311l97kz27qm4ypm8tchmwf1c4ntfew1kh12of05t9qur01tdx0e5ku82u03i6h1sstl5a65zg6k/webhook']);
//    dd($response);
//});
////Установка вебхука для телеграм бота UMНelp
//Route::get('/setwebhook-umhelp', function () {
//    $response = Telegram::bot('UMHelp')->setWebhook(['url' => 'https://unitedmarket.org/eeekcitlzk9pjvp5t8upm6dp1pq7y9p39qu1iechklm7bgaole70c29lkcy58ys61eidvtmxtj2stidbh7eb76qqwih5zb0i3gnj/webhook']);
//    dd($response);
//});

// Авторизация через соц.сети
Route::get('{service}/auth', [SocialController::class, 'index'])->name('soc.auth');
Route::get('{service}/auth/callback', [SocialController::class, 'callback']);

//Webhook для бота UMSend
Route::post('/fdmafqc1fq1qaz8yttgfsq2t311l97kz27qm4ypm8tchmwf1c4ntfew1kh12of05t9qur01tdx0e5ku82u03i6h1sstl5a65zg6k/webhook', function () {
    $update = Telegram::bot('UMSend')->commandsHandler(true);
    return 'ok';
});
//Webhook для бота UMHelp
Route::post('/eeekcitlzk9pjvp5t8upm6dp1pq7y9p39qu1iechklm7bgaole70c29lkcy58ys61eidvtmxtj2stidbh7eb76qqwih5zb0i3gnj/webhook', function () {
    $update = Telegram::bot('UMHelp')->commandsHandler(true);
    return 'ok';
});
Route::post('/error500_send', [SendError500Component::class, 'sendError500'])->name('error_500');
/**
 * Вебхук для yookassa и контроллер yookassa
 */
Route::match(['GET', 'POST'], '/payments/callback', [YookassaController::class, 'callback'])->name('payment.callback');
Route::post('/payments-create', [YookassaController::class, 'create'])->name('payment.create');

if (Features::enabled(Features::emailVerification())) {
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify');
}

/**Зашита всех маршрутов firewall.
 * https://github.com/akaunting/laravel-firewall
 */

Route::group(['middleware' => 'firewall.all'], function () {
//Route for redirect
    Route::redirect('contacts.html', '/info/o-nas');

//For PWA
    Route::get('/offline', OfflineComponent::class)->name('offline');

//For all
//    Route::get('/info-cooperation', CooperationComponent::class)->name('info.cooperation');
    Route::get('/investor_landing', InvestorLandingPage::class)->name('investor.page');

    Route::redirect('/info-cooperation', '/without_conditions_cooperation');
    Route::get('/without_conditions_cooperation', CooperrationNoOption::class)->name('info.cooperation.nooption');

    Route::get('/franchise', FranchiseSaleComponet::class)->name('franchise.sale');

//        ->name('franchise.sale');
    Route::get('/', HomeComponent::class)->name('home');
    Route::get('/cart', CartComponent::class)->name('product.cart');

    Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    Route::get('{city_slug}/product/{slug}', DetailsComponent::class)->name('product.details');
    Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');
    Route::get('/search', SearchComponent::class)->name('product.search');
    Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');
    Route::get('/success/{transactionId}', SuccessComponent::class)->name('success');
    Route::get('/info/{slug}', InformationComponent::class)->name('info');
    Route::get('/no-partner', NoPartnerComponent::class)->name('nopartner');
    Route::get('/promotions', PromotionsComponent::class)->name('promotions');


    Route::post('/mail-partner', [MailController::class, 'sendApplication'])->name('send.mail');
//    Route::match(['GET', 'POST'], '/auth', AuthComponent::class)->name('auth');//Disabled the old authorization method
    Route::match(['GET', 'POST'], '/auth', AuthByCall::class)->name('auth');
    Route::match(['GET', 'POST'], '/auth/{referral_slug}', AuthComponent::class)->name('auth.referral');


//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
//for CloneSite
    Route::get('/inform/polzovatelskoe-soglashenie', ClonePolzovatelskoeSoglashenie::class)->name('clone.soglashehie');
    Route::get('/inform/politic-konfidencialnosti', ClonePolitikaKonfidencialnosti::class)->name('clone.politic');
    Route::get('/inform/oplata', CloneOplata::class)->name('clone.oplata');





// for User or Customer
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
        Route::get('/user/create_shop', UserCreateShopComponent::class)->name('user.create-shop');
        Route::get('/user/settings', UserSettingsComponent::class)->name('user.settings');
        Route::get('/user/notifications', UserNotificationsComponent::class)->name('user.notifications');
        Route::get('/user/delivery', UserDeliveryComponent::class)->name('user.delivery');
        Route::get('/user/orders-history', UserOrdersHistoryComponent::class)->name('user.orders-history');
        Route::get('/user/review', UserReviewComponent::class)->name('user.review');
        Route::get('/user/promo', UserPromoComponent::class)->name('user.promo');
        Route::get('/user/bonuses', UserBonusComponent::class)->name('user.bonus');
        Route::get('/user/referral', UserReferralComponent::class)->name('user.referral');
        //for potential partner
        Route::get('/partner_form_registration', PartnerFormRegistrationComponent::class)->name('partner.form.registration');
        Route::get('/general_partner', FranchiseSaleAprile::class)->name('general.partner');
    });

// for partner


    Route::get('/ip-contract', \App\Http\Livewire\ContractTemplates\IpContractComponent::class);


    Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
        Route::group(['prefix' => 'admin/site'], function () {
            //Для сайтов клонов
            Route::get('/site_settings', SiteCloneSettingsComponent::class)->name('admin.site.settings');
            Route::get('/shops_slider', SiteCloneShopSliderSettings::class)->name('admin.shop.slider');
            Route::get('/shops_slider_bottom', SiteCloneShopBottomSliderSettings::class)->name('admin.shop.slider-bottom');
            Route::get('/shops_promotion', SiteClonePromotionSettings::class)->name('admin.shop.promotion');
            Route::get('/site_seo_settings', SiteCloneSeoSetting::class)->name('admin.seo.settings');
        });


//        //Для сайтов клонов
//        Route::get('/site_settings', SiteCloneSettingsComponent::class)->name('site.settings');
//        Route::get('/admin/site/shopslider', SiteCloneShopSliderSettings::class)->name('site.shopslider.settings');

        //Для обновления данных партнеров в базе.
        Route::get('/partner_update_data', FormUpdateDataForContract::class)->name('partner.data.update');


        Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
        Route::get('/admin/wallet', WalletComponent::class)->name('admin.wallet');
        Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
        Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
        Route::get('/admin/category/edit/category_id={category_id}', AdminEditCategoryComponent::class)->name('admin.editcategory');
        Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
	Route::get('/admin/add/product', AdminAddProductComponent::class)->name('admin.addproduct');
        Route::get('/admin/product/edit/product_id={product_id}', AdminEditProductComponent::class)->name('admin.editproduct');
        Route::get('/admin/settings', AdminSettingsComponent::class)->name('admin.settings');
        Route::get('/admin/orders', AdminOrdersComponent::class)->name('admin.orders');
        Route::get('/admin/accounting', AdminAccountingComponent::class)->name('admin.accounting');


        Route::get('/admin/download_contract', [PDFController::class, 'generatePDF'])->name('download.contract');

//        route for dev
//    Route::get('backend/hack', \App\Http\Livewire\AdminHacker\HackingCabinet::class);
//
//    Route::get('backend/sql', \App\Http\Livewire\SqlReguest::class);


    });

    Route::match(['GET', 'POST'], '/getorders/{slug}', [GetOrdersController::class, 'getOrders'])->name('get.orders');

//SEO
    Route::get('/sitemap', [SiteMapComponent::class, 'getSiteMap'])->name('sitemap');




    Route::get('for_manager/{filename}', [FileLockController::class, 'licenceFileShow'])->name('for_manager');
    Route::get('{city_slug}/catalog/{direction_slug?}', ShopComponent::class)->name('shop');
    Route::get('{city_slug}/catalog/{direction_slug?}/{slug?}', ShopComponent::class)->name('product.shop');
//Route::get('{city_slug}/{direction_slug}',ShopComponent::class)->name('shop');
//Route::get('{city_slug}/{direction_slug}/{slug}',ShopComponent::class)->name('product.shop');


});
Route::group(['prefix' => 'backend'], function () {
    Voyager::routes();
    //Ajax
//    Route::post('/products/get_options', [ProductsController::class, 'getOptions'])->name('get.options');
//    Route::post('/products/get_partners', [ProductsController::class, 'getPartners'])->name('get.partners');
    //Option

    Route::get('/exel_price', \App\Http\Livewire\Exel\PriceImportComponent::class);
    Route::get('/all_base_backup', function () {
        $output = Artisan::call('base:backup');
        return 'Резервная копия создана.';
    });

    Route::post('/products/get_option_value', [ProductsController::class, 'getOptionsValue'])->name('get.options.value');
    Route::post('/products/del_option_value', [ProductsController::class, 'delOptionValue'])->name('del.option.value');
    //Partners
    Route::post('/products/get_partners', [ProductsController::class, 'getPartners'])->name('get.partners');
// Route::post('/instruction/{instruction_id}',InstructionForManagersComponent::class)->name('instruction.manager');
    // route for managers
    Route::get('/add/{city_name}', AddCityComponent::class)->name('add.city');
});
