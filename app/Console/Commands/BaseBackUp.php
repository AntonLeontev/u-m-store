<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class BaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'base:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $filename = "auto_backup_unitedmarket__" . Carbon::now()->format('H.i.s__d-m-Y') . ".zip";

//        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | zip > " . storage_path() . "/app/backup/" . $filename;

//        dd($command);
        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
//        Отправка Резервной копии в телеграм.

        $chat_id = '464744447'; // мой id в телеге
        Telegram::sendDocument([
            'chat_id' => '464744447',
            'document' => \Telegram\Bot\FileUpload\InputFile::create(storage_path() . "/app/backup/" . $filename),
            'caption' => 'Резервная базы данных umarket',
        ]);
    }
}
