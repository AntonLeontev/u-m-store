<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
//Очередь для создания кошелька
use App\Jobs\ChainApi\generateWallet;

class UserRegisterForm extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    use PasswordValidationRules;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required','required_with:password','same:password'],
        ];
    }

    /**
     * Позволяет показывать ошибки в реальном времени
     * @param $propertyName
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function registerUser() {

        $attr = $this->validate();

        // событие отправки почты
        event(new Registered($user = User::create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'password' => Hash::make($attr['password']),
        ])));

        // аутентифицируем пользователя
        Auth::login($user);
        //Создаем кошелек пользователю.
        generateWallet::dispatch($attr['password'], Auth::user());
        redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.user-register-form');
    }
}
