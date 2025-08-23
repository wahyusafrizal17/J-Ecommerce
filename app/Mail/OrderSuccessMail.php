<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // <--- Penting: pastikan variabel ini ada

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
{
    return $this->subject('Pesanan Anda Berhasil')
                ->markdown('frontend.mail.order_success');
}

}
