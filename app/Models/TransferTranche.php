<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTranche extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id')->first();
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id')->first();
    }
    public function devise(){
        return $this->belongsTo(Devise::class,'devise_id')->first();
    }

    public function tranches(){
        return $this->hasMany(TransferTrancheInstance::class)->get();
    }

    public function transfer(){
        return $this->belongsTo(Transfer::class,'transfer_id')->first();
    }
    
}
