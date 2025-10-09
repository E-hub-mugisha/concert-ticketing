<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $pdfs;

    public function __construct(Order $order, array $pdfs)
    {
        $this->order = $order;
        $this->pdfs = $pdfs;
    }

    public function build()
    {
        $email = $this->subject('Your Event Tickets - ' . $this->order->customer_name)
            ->view('emails.tickets');

        foreach ($this->pdfs as $pdf) {
            $email->attachData($pdf['content'], $pdf['filename']);
        }

        return $email;
    }
}
