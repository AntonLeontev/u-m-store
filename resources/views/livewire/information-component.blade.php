@push('head')
    <link rel="stylesheet" href="{{ asset('css/another.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/file.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endpush
<div>
    <div class="wrapper">
        <div class="content">
            <section class="major">
                <div class="container">
                    <div class="major__inner">
                        <div class="major__breadcrumbs">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><span>{{$article_name}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            @if($slug=='o-nas')
                @livewire('info.o-nas-component')
            @elseif($slug=='dejstvuyushim-partneram')
                @livewire('info.dejstvuyushim-partneram-component')
            @elseif($slug=='dostavka')
                @livewire('info.dostavka-component')
            @elseif($slug=='katalog')
                @livewire('info.katalog-component')
            @elseif($slug=='oplata')
                @livewire('info.oplata-component')
            @elseif($slug=='politika-konfidencialnosti')
                {{-- @livewire('info.politika-konfidencialnosti-component', ['article' => $article->description]) --}}
				<section class="privacy">
					<div class="container">
						<div class="privacy__inner">
							<div class="privacy__text">
								{!! $article->description !!}
							</div>
						</div>
					</div>
				</section>
            @elseif($slug=='polzovatelskoe-soglashenie')
                {{-- @livewire('info.polzovatelskoe-soglashenie-component') --}}
				<section class="agreement">
					<div class="container">
						<div class="agreement__inner">
							<div class="agreement__text">
								{!! $article->description !!}
							</div>
						</div>
					</div>
				</section>
            @elseif($slug=='referalnaya-programma')
                @livewire('info.referalnaya-programma-component')
            @elseif($slug=='sotrudnichestvo')
                @livewire('info.sotrudnichestvo-component')
            @endif
        </div>
    </div>
    @include('livewire.includes.collaboration-partner-form')
</div>
@push('footer')
    <script src="{{asset('js/main.js')}}"></script>
@endpush
