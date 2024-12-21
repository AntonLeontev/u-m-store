
<form class="form-stl" wire:submit.prevent="registerUser">
    @csrf
    <div class="signReg__description">{{__('Name')}}</div>
    <div class="sign-input__block">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="signReg__description">{{__('Email Address')}}</div>
    <div class="sign-input__block">
        <input type="email" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="signReg__description">{{__('Password')}}</div>
    <div class="sign-input__block">
        <input type="password" wire:model="password">
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="signReg__description">{{__('Confirm Password')}}</div>
    <div class="sign-input__block">
        <input type="password" wire:model="password_confirmation">
        @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
    </div>
    <input type="submit" class="btn btn-sign">
</form>
