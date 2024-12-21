<?php

namespace App\Http\Controllers\Payment;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController\MailController;
use App\Http\Livewire\CheckoutComponent;
use App\Models\Checkout\Order;
use App\Models\Checkout\Transaction;
use App\Services\YookassaService;
use Illuminate\Http\Request;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;
use Cart;

class YookassaController extends Controller
{



    public function callback(Request $request, YookassaService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notifocation = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        $payment = $notifocation->getObject();

        if(isset($payment->status) && $payment->status === 'waiting_for_capture')
        {
            $service->getClient()->capturePayment(
                [
                   'amount' => $payment->amount
                ], $payment->id, uniqid('', true));
        }

        if(isset($payment->status) && $payment->status === 'succeeded')
        {
            if((bool)$payment->paid === true)
            {
                $metadata =  (object)$payment->metadata;
                if(isset($metadata->transaction_id))
                {
                    $transaction = Transaction::find($metadata->transaction_id);
                    if($transaction) {
                        $transaction->status = StatusEnum::CONFIRMED;
                        $transaction->save();
                        $order = Order::find($transaction->order_id);
                        if($order)
                        {
                            $order->total = $payment->amount->value;
                            $order->status = StatusEnum::PAYED;
                            $order->save();
                            (new MailController())->sendOrderMail($order);


                        }
                    }



//                    $payment->amount->value;
                }
            }
        }
    }
}
