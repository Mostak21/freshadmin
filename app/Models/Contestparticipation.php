<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app;


class Contestparticipation extends Model
{
    //
    use HasFactory;
    public function participate(){
        return $this->hasOne(User::class, 'id','user');
    }

    public function participation(){
        return $this->hasMany(Contestparticipation::class, 'user','user');
    }

    public function win(){
        return $this->hasMany();
    }

    public function loose(){
        return $this->hasMany(Contestparticipation::class, 'user','user');
    }
}
