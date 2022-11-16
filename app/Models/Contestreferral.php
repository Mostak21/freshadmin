<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app;


class Contestreferral extends Model
{
    use HasFactory;

    public function participate(){
        return $this->hasOne(User::class, 'id','user');
    }

    public function referred_participate(){
        return $this->hasOne(User::class, 'id','user');
    }
}
