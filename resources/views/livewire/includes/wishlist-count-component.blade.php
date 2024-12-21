{{--<div class="wrap-icon-section wishlist">--}}
{{--    <a href="{{ route('product.wishlist') }}" class="link-direction">--}}
{{--        <i class="fa fa-heart" aria-hidden="true"></i>--}}
{{--        <div class="left-info">--}}
{{--            @if(Cart::instance('wishlist')->count() > 0)--}}
{{--                <span class="index">{{Cart::instance('wishlist')->count()}} item</span>--}}
{{--            @endif--}}
{{--            <span class="title">Wishlist</span>--}}
{{--        </div>--}}
{{--    </a>--}}
{{--</div>--}}
<div class="header__save">
    <a href="{{ route('product.wishlist') }}">
        <div class="header__img">
            <svg width="29" height="26" viewBox="0 0 29 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.4583 4.75367C22.3068 1.93205 17.9884 2.40525 16.4767 5.62827C15.6832 7.31994 13.3168 7.31994 12.5233 5.62827C11.0116 2.40526 6.69315 1.93205 4.54174 4.75367L4.10155 5.331C2.21038 7.81129 2.48344 11.3483 4.73202 13.4977L14.5 22.8348L24.268 13.4977C26.5166 11.3483 26.7896 7.81129 24.8985 5.33099L24.4583 4.75367ZM14.5 3.33194C17.3131 -0.869114 23.5058 -1.21964 26.7068 2.97852L27.1469 3.55584C29.9379 7.21628 29.535 12.4363 26.2165 15.6083L16.3233 25.0651C16.314 25.074 16.3045 25.0831 16.2948 25.0924C16.1504 25.2306 15.9762 25.3973 15.8089 25.5284C15.6113 25.6832 15.3148 25.8787 14.911 25.9593C14.6396 26.0135 14.3604 26.0135 14.089 25.9593C13.6852 25.8787 13.3887 25.6832 13.1911 25.5284C13.0238 25.3973 12.8497 25.2306 12.7052 25.0924C12.6955 25.0832 12.686 25.0741 12.6767 25.0651L2.78351 15.6083C-0.534952 12.4363 -0.937933 7.21629 1.85306 3.55585L2.29325 2.97853C5.49424 -1.21963 11.6869 -0.869115 14.5 3.33194Z" fill="#0B1331" stroke="none"/>
            </svg>
        </div>
{{--        <div class="header__name">Сохранено</div>--}}
{{--        <div class="wishlist__circle">{{Cart::instance('wishlist')->count()}}</div>--}}
    </a>
    @if(Cart::instance('wishlist')->count() > 0)
    <div class="item__save">
        <ul>
            @foreach(Cart::instance('wishlist')->content() as $item)
            <li><a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$item->model->id]) }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
