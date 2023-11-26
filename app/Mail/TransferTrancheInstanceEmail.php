<?php

namespace App\Mail;

use App\Models\TransferTranche;
use App\Models\TransferTrancheInstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferTrancheInstanceEmail extends Mailable
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
        return $this->instance->type == "reception" ? $this->view('emails.transfer_tranche.instance_reception')
        ->subject("Transfert par tranche: nouveau paiement") : $this->view('emails.transfer_tranche.instance')
                    ->subject("Transfert par tranche: nouveau paiement");
    }
}
