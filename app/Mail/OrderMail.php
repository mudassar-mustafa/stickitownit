<?php

namespace App\Mail;

use App\Models\OrderPackageDetail;
use App\Models\OrderSaleDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->order->order_type == 'Sale') {
            $orderDetails = OrderSaleDetail::where('order_id', $this->order->id)->get();
        } else {
            $orderDetails = OrderPackageDetail::where('order_id', $this->order->id)->get();
        }

        return $this->subject('Order Confirmation - ' . 'ST-' . date('Y', strtotime($this->order->created_at)) . '-' . $this->order->id)->view('mails.order-mail', compact('orderDetails'));
    }
}
