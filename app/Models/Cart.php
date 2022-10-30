<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = ['address_id','price','tax','shipping_cost','discount','product_referral_code','coupon_code','coupon_applied','quantity','user_id','temp_user_id','owner_id','product_id','variation','abandoned_cart'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function product_stock()
    {
//        return $this->hasMany(ProductStock::class,'product_id','product_id');
        return $this->hasOne(ProductStock::class,'product_id','product_id');

//        return $this->belongsTo(ProductStock::class,['product_id','variant'],['product_id','variation']);
//        return $this->hasMany(ProductStock::class,['product_id','variant'],['product_id','variation']);
//        ->where('variant','variation');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
