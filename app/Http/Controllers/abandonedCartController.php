<?php

namespace App\Http\Controllers;

use App\Mail\AbandonedCartEmailManager;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Mail;


class abandonedCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCartList(){
        $mytime = Carbon::yesterday();
        $carts = Cart::whereNotNull('user_id')
            ->where('updated_at', '<', $mytime)
            ->select('id','user_id','product_id','variation','quantity','price','abandoned_cart','updated_at')
            ->whereHas('user', function ($query) {
                $query->select('id')
                    ->whereNotNull('email')
                    ->where('user_type','customer')
                    ->whereNotNull('email_verified_at');
            })->with('user:id,name,email,phone')
            ->whereHas('product_stock', function ($query) {
                $query->where('product_stocks.qty','>','0')
                    ->whereRaw('`carts`.`variation` = `product_stocks`.`variant`');
            })
            ->with('product:id,name,thumbnail_img')
            ->with('product_stock')
            ->orderBy('id', 'DESC')
            ->get();
        return $carts;
    }
    public function StockOutCartList(){
        $mytime = Carbon::yesterday();
        $carts = Cart::whereNotNull('user_id')
            ->where('updated_at', '<', $mytime)
            ->select('id','user_id','product_id','variation','quantity','price','abandoned_cart','updated_at')
            ->whereHas('user', function ($query) {
                $query->select('id')
                    ->whereNotNull('email')
                    ->where('user_type','customer')
                    ->whereNotNull('email_verified_at');
            })->with('user:id,name,email,phone')
            ->whereHas('product_stock', function ($query) {
                $query->where('product_stocks.qty','=','0')
                    ->whereRaw('`carts`.`variation` = `product_stocks`.`variant`');
            })
            ->with('product:id,name,thumbnail_img')
            ->with('product_stock')
            ->orderBy('id', 'DESC')
            ->get();
        return $carts;
    }

    public function index(Request $request)
    {
//        $cartlist = $this->getCartList();
        $cartlist = $this->StockOutCartList();
//        return dd($cartlist->count());
        $id = 0;
        $this->AbandonedCartEmail($cartlist[$id]);
        return dd($cartlist[$id]->getAttributes(), $cartlist[$id]->product_stock->getAttributes(), $cartlist[$id]->user);
    }

    public function AbandonedCartEmail($carts)
    {
//        if ($carts->abandoned_cart == 1){
//            $carts->abandoned_cart = 0;
//            $carts->save();


            if (env('MAIL_USERNAME') != null ) {
                $array['view'] = 'emails.abandoned_cart';
                $array['subject'] = 'We\'re holding the items in your cart for you';
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['carts'] = $carts;
//                dd($cart->user->email);
                try {
                    Mail::to($carts->user->email)->queue(new AbandonedCartEmailManager($array));

                } catch (\Exception $e) {
                    return dd("email not sent",$carts->product->thumbnail_img,$carts->product->name,$carts->variation,$carts->quantity,single_price($carts->price),$e);
                }
            }
//        }
        return 1;
    }
}

