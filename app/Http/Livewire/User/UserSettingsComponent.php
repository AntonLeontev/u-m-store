<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SocialController;
use Livewire\Component;
use Livewire\WithFileUploads;
use Manny\Manny;

class UserSettingsComponent extends Component
{
    public $name;
    public $surname;
    public $phone;
    public $email;
    public $avatar;
    public $tmp_avatar;
    public $birthdate;
    public $city;
    public $addresses;
    public $is_main_adr; // осн.адресс
    public $soc_active;

    use WithFileUploads;

    public function mount()
    {
        $user = User::find(Auth::id());

        if($user)
        {

            // обновляем список адресов
            $this->refreshAdressList();

            $this->name = $user->name;
            $this->surname = $user->surname;
            $this->phone = $user->phone;
            $this->email = $user->email;
            $this->city = null;
            $this->address = null;
            $this->avatar = $user->avatar;
            $this->birthdate = Carbon::parse($user->birthdate)->format('m.d.Y');
            $this->is_main_adr = false; // по умолчанию false
            $this->soc_active = SocialController::getUserSocials($user->id);
        }
    }

    protected function rules()
    {
        return [
          'name' => 'required',
          'phone'=> 'required',
          'birthdate' => 'date_format:m.d.Y'
          //'city'=> 'required'
        ];
    }

    public function phoneMask()
    {
        if(strlen($this->phone) > 9) $this->phone = Manny::mask($this->phone, '1(111) 111 11 11');
    }

    private function refreshAdressList() {
        $main_adr = DB::table('users')
            ->select('city', 'address')
            ->where('id', Auth::id())->get();

        $add_adr = DB::table('user_addresses')
            ->select('city', 'address')
            ->where('user_id', Auth::id())->get();

        // возращает только не пустые значения
        $this->addresses = $main_adr->merge($add_adr)->reject(function($addr) {
            return empty($addr->city) || empty($addr->address);
        });
    }

    public function setSettings()
    {

       $this->validate();

       $user = User::find(Auth::id());
       if($user)
        {

       if($user->phone !== $this->phone && User::firstWhere('phone', $this->phone))
       {
           session()->flash('phone_not_unique', true);
           return false;
       }

        if($user->email !== $this->email && User::firstWhere('email', $this->email))
        {
            session()->flash('email_not_unique', true);
            return false;
        }


           $user->name = $this->name;
           $user->surname = $this->surname;
           $user->phone = $this->phone;
           $user->email = $this->email;
           $user->city = $this->city;
           if($this->tmp_avatar)  {
               $folder_with_month = Carbon::now()->format('FY');
               $avatarName = Carbon::now()->timestamp . '.' . $this->tmp_avatar->extension();
               $tmp_avatar_path = $this->tmp_avatar->storeAs('avatars/'. $folder_with_month, $avatarName);
               $user->avatar = $tmp_avatar_path;
           }
           $user->address = $this->address;
           // переводим в формат сохранения Y-m-d
           $user->birthdate = Carbon::createFromFormat('d.m.Y', $this->birthdate)->format('Y-m-d');
           $user->save();
           session()->flash('success', true);
       }
    }

    // добавляет адресс для поль-ля
    public function addAddress() {

        $user = User::find(Auth::id());

        if($user) {

            $main_adr_exists = DB::table('users')
                ->where('id', $user->id)
                ->where('city', $this->city)
                ->where('address', $this->address)->exists();

            $secondary_adr_exists = DB::table('user_addresses')
                ->where('user_id', $user->id)
                ->where('city', $this->city)
                ->where('address', $this->address)->exists();

            // если такого адреса не существует
            if(!$main_adr_exists && !$secondary_adr_exists) {
                // если указано, что основной адрес то пишем в user
                if($this->is_main_adr) {
                    $user->city = $this->city;
                    $user->address = $this->address;
                    $user->save();

                } else {
                    // иначе в колонку с доп. адресами
                    DB::table('user_addresses')->insert([
                        'user_id' => $user->id,
                        'city' => $this->city,
                        'address' => $this->address
                    ]);
                }
            } else {
                // добавляем сообщение о том, что такой адрес уже есть
                $this->addError('not_unique', 'Такой адресс уже существут в базе данных.');
            }
        }
    }

    /*
     * удалить адресс
     */
    public function deleteAddress($key = 0) {
        if($key == 0) {
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['city' => null, 'address' => null]);
        } else {
            DB::table('user_addresses')
                ->where('user_id', Auth::id())
                ->where('city', $this->addresses[$key]['city'])
                ->where('address', $this->addresses[$key]['address'])
                ->delete();
        }
    }

    /*
     * удаляет поль-ля и разлогинивает его
     */
    public function deleteAccount() {
        // 1. если ушпешно удалился аккаунт
        if(User::where('id', Auth::id())->delete()) {
            DB::table('socials')->where('user_id', Auth::id())->delete();
            auth('web')->logout();
            $this->redirect(route('home'));
        }
         return false;
    }

    public function render()
    {

        // обновляем список адресов
        $this->refreshAdressList();

        return view('livewire.user.user-settings-component', [
            'fullname' => $this->name . ' ' . $this->surname,
            // 'email' => $this->email,
            // 'phone' => $this->phone,
            // переводим в формат для picker
            // 'birth_date' => $this->birthdate,
            'addresses' => $this->addresses,
            'socials' => $this->soc_active,
            // 'avatar' => $this->avatar
        ])->layout('layouts.base');
    }
}
