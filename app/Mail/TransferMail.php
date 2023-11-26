<?php

namespace App\Mail;

use App\Models\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transfer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transfer $tr)
    {
        $this->transfer = $tr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.transfer.transfer')
                    ->subject("Nouveau transfert");
    }
}
