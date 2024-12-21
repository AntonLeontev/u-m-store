<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $tmp_img_url;
    private $save_img_url;
    private $img_with;

    public function __construct($tmpUrl, $saveUrl, $imgWith = 800)
    {
        // временный путь хранения файла
        $this->tmp_img_url = $tmpUrl;
        // место сохранения файла
        $this->save_img_url = $saveUrl;
        // ресайз (по умолчанию 800)
        $this->img_with = $imgWith;
    }

    /**
     * Задает временной предел попыток выполнения задания.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        // будет пытаться сделать ресайз не больше 10 минут
        return now()->addMinutes(10);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Image::make($this->tmp_img_url)
            ->resize($this->img_with)
            ->save($this->save_img_url);
    }
}
