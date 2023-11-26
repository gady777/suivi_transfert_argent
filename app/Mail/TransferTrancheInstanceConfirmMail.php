<?php

namespace App\Mail;

use App\Models\Transfer;
use App\Models\TransferTranche;
use App\Models\TransferTrancheInstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferTrancheInstanceConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transfer;
    public $instance;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TransferTranche $tr, TransferTrancheInstance $ti)
    {
        $this->transfer = $tr;
        $this->instance = $ti;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.transfer_tranche.instance_confirm')
                    ->subject("Transfert par tranche: confirmation de réception");
    }
}
