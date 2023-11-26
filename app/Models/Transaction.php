<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class,'user_id')->first();
    }
    public function recipient(){
        return $this->belongsTo(Recipient::class,'recipient_id')->first();
    }
    public function countryFrom(){
        return $this->belongsTo(Country::class,'country_from_id')->first();
    }

    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id')->first();
    }

    public function devise(){
        return $this->belongsTo(Devise::class,'devise_id')->first();
    }
}
