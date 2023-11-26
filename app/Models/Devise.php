<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devise extends Model
{
    use HasFactory;

    public function processingFee(){
        return $this->hasOne(ProcessingFee::class,'currency_id');
    }
}
