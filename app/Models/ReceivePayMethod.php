<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivePayMethod extends Model
{
    use HasFactory;

    public function method(){
        return $this->belongsTo(TransferMethod::class,'method_id')->first();
    }
}
