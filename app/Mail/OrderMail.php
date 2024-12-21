<?php

namespace App\Mail;

use App\Models\Checkout\Order;
use App\Models\Checkout\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $options;
    public $view;
    public $order_products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($options, $view)
    {
        $this->options = $options;
        $this->view = $view;
        if(isset($options->id)) $this->order_products = OrderProduct::where('order_id', $options->id)->get();
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('UnitedMarket')->view($this->view);
    }
}
