<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    public function currency(){
        return $this->belongsTo(Devise::class,'devise_id')->first();
    }

    public function method(){
        return $this->belongsTo(DepotMethod::class,'method_id')->first();
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id')->first();
    }
}
