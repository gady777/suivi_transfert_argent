<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class,'idUser')->first();
    }

    public function currency(){
        return $this->belongsTo(Devise::class,'devise')->first();
    }
}
