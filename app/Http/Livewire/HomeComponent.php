<?php

namespace App\Http\Livewire;


use App\Helpers\SiteClone\CloneInfo;
use App\Helpers\UmHelp;
use App\Models\ClonePromotion;
use App\Models\CloneSiteInformation;
use App\Models\Product;
use App\Models\Product_to_store;
use App\Models\Promotion;
use App\Models\QuestionsRemainGeneralPartner;
use App\Models\SEO\PartnerSeo;
use App\Models\Store;
use Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class HomeComponent extends Component
{

    public $questions_name = '';
    public $questions_phone;
    public $questions_email;
    public $questions_message;

    public function questionsRemain()
    {
        $this->validate([
            'questions_name' => 'required|max:60',
            'questions_phone' => 'required|max:20',
            'questions_email' => 'required|max:60',
            'questions_message' => 'required|max:250',

        ]);
        #Write to database
        $question = QuestionsRemainGeneralPartner::create([
            'status' => 'CREATE',
            'questions_name' => $this->questions_name,
            'questions_phone' => $this->questions_phone,
            'questions_email' => $this->questions_email,
            'questions_message' => $this->questions_message,
        ]);

        #Send a message to telegram
        $question_arr = $question->toArray();
        $question_arr['Вопрос №'] = $question_arr['id'];
        $question_arr['Источник'] = url()->current();
        $question_arr['Имя'] = $question_arr['questions_name'];
        $question_arr['Телефон'] = $question_arr['questions_phone'];
        $question_arr['Email адрес'] = $question_arr['questions_email'];
        $question_arr['Текст сообщения'] = $question_arr['questions_message'];

        unset($question_arr['created_at']);
        unset($question_arr['updated_at']);
        unset($question_arr['status']);
        unset($question_arr['id']);
        unset($question_arr['questions_name']);
        unset($question_arr['questions_phone']);
        unset($question_arr['questions_email']);
        unset($question_arr['questions_message']);


        $response = UmHelp::sendTelegramToManager($question_arr,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', config('telegram.chats.applications'));
        $this->reset(['questions_name', 'questions_phone','questions_email','questions_message']);
        if ($response) {
			session()->flash('success_question');
		} else {
			session()->flash('error_question');
            $this->emit('alert_remove');
		}
    }

    public function store($product_id, $product_name, $product_price, $product_image)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['image' => $product_image])->associate('App\Models\Product');
        $this->emitTo('includes.cart-count-component', 'refreshComponent');

        session()->flash('success_massage', 'Item added in Cart');
    }


    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
    }

    public function removeFromWishList($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
            }
        }
    }



    public function submitPartner()
    {

        $this->validate([
			// 'questions_name' => 'required|max:60',
            'questions_email' => 'required|max:60',
            'questions_message' => 'required|max:250',
        ]);

        #Write to database
        $question = QuestionsRemainGeneralPartner::create([
            'status' => 'CREATE',
            'questions_name' => $this->questions_name,
            'questions_email' => $this->questions_email,
            'questions_message' => $this->questions_message,
        ]);

        #Send a message to telegram
        $question_arr = $question->toArray();
        $question_arr['Вопрос №'] = $question_arr['id'];
        $question_arr['Источник'] = url()->current();
        $question_arr['Имя'] = $question_arr['questions_name'];
        $question_arr['Email адрес'] = $question_arr['questions_email'];
        $question_arr['Текст сообщения'] = $question_arr['questions_message'];

        unset($question_arr['created_at']);
        unset($question_arr['updated_at']);
        unset($question_arr['status']);
        unset($question_arr['id']);
        unset($question_arr['questions_name']);
        unset($question_arr['questions_email']);
        unset($question_arr['questions_message']);


        $response = \App\Helpers\UmHelp::sendTelegramToManager($question_arr,'Заявка на сотрудничество ruchain', 464744447);
        $response = UmHelp::sendTelegramToManager($question_arr,'Заявка на сотрудничество ruchain', -1001679721539);
        $this->reset(['questions_name','questions_email','questions_message']);
        if ($response) session()->flash('success_question');
        else session()->flash('error_question');
        $this->emit('alert_remove');
    }



    public function render(Request $request)
    {
        $store_id = Store::store_id();
        Cart::instance('cart')->store($request->ip() . $store_id);
        Cart::instance('wishlist')->store($request->ip() . $store_id);

        $popular_products = Product::getProducts()->limit(5)->get();
        $popular_products = Product::setProductsRating($popular_products);

        $new_products = Product::getProducts()->orderBy('products.created_at', 'ASC')->limit(5)->get();
        $new_products = Product::setProductsRating($new_products);

        //SEO  title, description, keywords получаем из хелпера.

        $seo = '';
//        Получаем текущий домен

//
        if (session()->get('domain') && $clone_info = CloneSiteInformation::getInfo()) {

                $seo = PartnerSeo::select('home_tags')->where('partner_id', CloneInfo::getParnterId())->first();
                if($seo) {
                    $seo = $seo->home_tags;
                }

                $new_products = Product_to_store::leftJoin('products', 'products.id', '=', 'product_to_stores.product_id')
                    ->where('products.partner_id', CloneInfo::getParnterId())
                    // ->where('products.status', 1)
                    ->where('product_status', 1)
                    ->where('products.moderated', 1)
                    ->orderBy('products.created_at', 'DESC')
					->limit(10)->get();

                $new_products = Product::setProductsRating($new_products);

				$promotions = ClonePromotion::where('partner_id', CloneInfo::getParnterId())->get();

                return view('livewire.for-clone.clone-home-page', compact(
                    'popular_products',
                    'new_products',
                    'seo',
					'promotions',
                ))->layout('layouts.base');


        } else {
            $seo = UmHelp::SeoTransformationTemplates('Home');
            // return view('livewire.home-component', compact(
            //     'popular_products',
            //     'new_products',
            //     'seo',
            // ));

			return view('livewire.info.cooperration-no-option')->layout('layouts.base');
        }

    }
}
