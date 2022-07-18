<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class DeliveryCost extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function agent(){
        return $this->belongsTo(DeliveryAgent::class,'delivery_agent_id');
    }
}
