<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTrancheInstance extends Model
{
    use HasFactory;

    public function transfer(){
        return $this->belongsTo(TransferTranche::class,'transfer_tranche_id')->first();
    }
    public function recipient(){
        return $this->belongsTo(Recipient::class,"recipient_id")->first();
    }
    public function method(){
        return $this->belongsTo(TransferMethod::class,"transfer_method_id")->first();
    }
    public function devise(){
        return $this->belongsTo(Devise::class,"devise_id")->first();
    }
}
