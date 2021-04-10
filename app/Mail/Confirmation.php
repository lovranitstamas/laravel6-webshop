<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $product;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param $order
     * @param $product
     * @param $user
     */
    public function __construct($order, $product, $user)
    {
        $this->order = $order;
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(\Config::get('mail.sender'))
            ->view('frontend.mail.confirmation')
            ->with('order', $this->order)
            ->with('product', $this->product)
            ->with('user', $this->user);
    }
}
