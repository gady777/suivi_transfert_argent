<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class,'user_id')->first();
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->first();
    }
    public function recipient(){
        return $this->belongsTo(Recipient::class)->first();
    }
    public function countryFrom(){
        return $this->belongsTo(Country::class,'country_from_id')->first();
    }
    public function method(){
        return $this->belongsTo(TransferMethod::class,'transfer_method_id')->first();
    }
     public function tranche(){
        return $this->belongsTo(TransferTranche::class,'tranche_id')->first();
    }
}
