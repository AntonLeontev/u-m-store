<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WhatsUpSms extends Command {
    protected $signature = 'base:sms';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table('flowers_phones')->insert([
            'phone' => '$r[0]',
            'text' => '$this->message',
            'token' => '$this->token',
            'city' => '$this->city',
            'status'=> 'added',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
