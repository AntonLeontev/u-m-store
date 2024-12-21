<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SessionsClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear
                            {ip? : IP адресс для которогу нужно удалить сессию.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing a session for a given ip.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ip = $this->argument('ip');
        if (!$ip){
            $defaultIndex = 0;
            $ip = $this->choice(
                'Для какого ip удалить сессии из базы?',
                ['195.216.211.125', '46.150.97.114'], $defaultIndex
            );
        }



        if ($this->confirm('Вы уверенны что хотите удалить все сессии для ip = '.$ip.' ?')) {
            DB::table('sessions')->where('ip_address', $ip)->delete();
            $this->info('Удаление сессий для ip ='.$ip.' успешно завершенно.');
        } else {
            $this->info('Очистка сессии отменена.');
        }


    }
}
