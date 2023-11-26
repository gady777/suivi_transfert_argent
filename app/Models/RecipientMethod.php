<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientMethod extends Model
{
    use HasFactory;

    public function recipient(){
        return $this->belongsTo(Recipient::class,'recipient_id')->first();
    }

    public function method(){
        return $this->belongsTo(TransferMethod::class,'transfer_method_id')->first();
    }
}
