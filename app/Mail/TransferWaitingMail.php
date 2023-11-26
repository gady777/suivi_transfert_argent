<?php

namespace App\Mail;

use App\Models\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferWaitingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transfer;
    public $rec_methods;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transfer $tr,$rec_methods)
    {
        $this->transfer = $tr;
        $this->rec_methods = $rec_methods;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.transfer.waiting')
                    ->subject("Transfert en cours de traitement");
    }
}
