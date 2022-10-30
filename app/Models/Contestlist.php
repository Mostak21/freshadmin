<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app;

class Contestlist extends Model
{
    use HasFactory;
    public function teamOne(){
        return $this->hasOne(Contestteam::class, 'id','team1');
    }

    public function teamTwo(){
        return $this->hasOne(Contestteam::class, 'id','team2');
    }
}
