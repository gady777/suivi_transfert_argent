<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    use HasFactory;

    public function devise(){
        return $this->belongsTo(Devise::class,'currency_id')->first();
    }
}
