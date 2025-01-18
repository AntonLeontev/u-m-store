@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
    <link rel="stylesheet" href="{{asset('css/download-product.css')}}">
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

<style>
	select::-ms-expand { display: none; /* Удаляем ненужную стрелку */ }
	select {
		-webkit-appearance: none; /* Для Chrome и Safari */
		-moz-appearance: none; /* Для Firefox */
		appearance: none; /* Для всех современных браузеров */
		background-color: white; /* Это очень важно */ 
	}

</style>

<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Партнеры</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Партнеры</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')

                        <div class="">
                            @include('livewire.admin.includes.mobile-main-menu')

							<div class="">
								<h1 style="margin-bottom: .5rem">Заявка на расчетно-кассовое обслуживание в Альфабанке</h1>

								<form class="download-product" @submit.prevent="sendApplication"
									x-data="{
										region: '',
										cities: [],
										errors: null,
										success: false,
										processing: false,
										
										sendApplication() {
											this.processing = true;
											this.errors = null;
											fetch('{{ route('admin.alfabank') }}', {
												method: 'POST',
												headers: {
													'Content-Type': 'application/json',
													'X-CSRF-TOKEN': '{{ csrf_token() }}',
													'Accept': 'application/json'
												},
												body: JSON.stringify(Object.fromEntries(new FormData(this.$event.target))),
											})
											.then(response => {
												if (!response.ok) {
													if (response.status === 422) {
														response.json()
															.then(data => {
																this.errors = data.errors;
															})
														
														this.processing = false;
														return;
													}

													this.processing = false;
													alert('Произошла ошибка');
													return;
												}

												this.success = true;
												this.processing = false;
											})
										},
										loadCities() {
											fetch('/admin/cities/' + this.region)
												.then(response => {
													if (!response.ok) {
														throw new Error('Network response was not ok');
													}
													return response.json();
												})
												.then(response => {
													this.cities = response;
												})
												.catch(error => {
													console.error('There was a problem with the fetch operation:', error);
												});
										},
										formatPhone() {
											this.$event.target.value = this.$event.target.value.replace(/\D/g, '');
										},
									}"
								>
									@csrf
									<div class="download-product__form-group">
										<input type="text" name="organizationName" placeholder="Название организации ООО Ромашка" class="download-product__form-input">
										<!-- вывод ошибок валидации -->
										<template x-if="errors?.organizationName">
											<span class="error" x-text="errors?.organizationName[0]"></span>
										</template>
									</div>

									<div class="download-product__form-group">
										<input type="text" name="inn" placeholder="ИНН" class="download-product__form-input">
										<!-- вывод ошибок валидации -->
										<template x-if="errors?.inn">
											<span class="error" x-text="errors?.inn[0]"></span>
										</template>
									</div>

									<div class="download-product__form-group">
										<input type="text" name="fullName" placeholder="ФИО" class="download-product__form-input">
										<!-- вывод ошибок валидации -->
										<template x-if="errors?.fullName">
											<span class="error" x-text="errors?.fullName[0]"></span>
										</template>
									</div>
									
									<div class="download-product__form-group">
										<input type="text" name="phoneNumber" placeholder="Номер телефона" class="download-product__form-input" @input="formatPhone">
										<!-- вывод ошибок валидации -->
										<template x-if="errors?.phoneNumber">
											<span class="error" x-text="errors?.phoneNumber[0]"></span>
										</template>
									</div>

									<div class="download-product__form-group">
										<select class="download-product__form-input" x-model="region" @change="loadCities">
											<option value="" selected disabled>Выберите регион</option>
											
											@foreach ($regions as $region)
												<option value="{{ $region->fias }}">{{ $region->name }}</option>
											@endforeach
										</select>
										<!-- вывод ошибок валидации -->
										@error("region") <span class="error">{{ $message }}</span> @enderror
									</div>
									
									<div class="download-product__form-group">
										<select class="download-product__form-input" name="cityCode">
											<option value="" selected disabled x-show="cities.length == 0" 
												x-text="cities.length == 0 ? 'Сначала выберите регион' : 'Выберите город'">Выберите город</option>
											
											<template x-for="city in cities">
												<option :value="city.fias" x-text="city.name"></option>
											</template>
										</select>
										<!-- вывод ошибок валидации -->
										<template x-if="errors?.cityCode">
											<span class="error" x-text="errors?.cityCode[0]"></span>
										</template>
									</div>

									<div class="download-product__form-group">
										<label>
											<input type="checkbox" name="products1" value="LP_ACQ_TR">
											<span>Мне понадобится торговый эквайринг</span>
										</label>
									</div>
									<div class="download-product__form-group">
										<label>
											<input type="checkbox" name="products2" value="LP_ACQ_E">
											<span>Мне понадобится интернет эквайринг</span>
										</label>
									</div>

									<template x-if="!success">
										<button :disabled="processing" class="download-product__btn js-next-btn">Отправить</button>
									</template>

									<template x-if="success">
										<p class="alert" style="color:green; margin-top: 15px">Заявка успешно отправлена. Представитель банка свяжется с Вами в ближайшее время</p>
									</template>
								</form>

							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	</div>
</div>




