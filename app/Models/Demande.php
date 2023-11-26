<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class,"idUser")->first();
    }
    public function user(){
        return $this->belongsTo(User::class,"idUser")->first();
    }
    public function receiver(){
        return $this->belongsTo(User::class,"receve")->first();
    }
}
