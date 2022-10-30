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

    public function carts(){
        $mytime = Carbon::yesterday();
        $carts = Cart::whereNotNull('user_id')
            ->where('updated_at', '<', $mytime)
//            ->where('abandoned_cart', '!=', 0)
//            ->where('abandoned_cart', 1)
            ->select('id','user_id','product_id','variation','quantity','price','abandoned_cart','updated_at')
            ->whereHas('user', function ($query) {
                $query->select('id')
                    ->whereNotNull('email')
                    ->where('user_type','customer')
                    ->where('subscribed',1)
                    ->whereNotNull('email_verified_at');
            })->with('user:id,name,email,phone')
            ->with('product:id,name,thumbnail_img')
            ->with('product_stock')
            ->orderBy('id', 'DESC');

        return $carts;
    }

    public function getCartList(){
        $carts = $this->carts();
        $carts = $carts->where('abandoned_cart', '!=', 0)->where('abandoned_cart', 1)
            ->whereHas('product_stock', function ($query) {
                $query->where('product_stocks.qty','>','0')
                    ->whereRaw('`carts`.`variation` = `product_stocks`.`variant`');
            })
            ->get();
        return $carts;
    }

    public function restockCartList(){
        $carts = $this->carts();

        $carts = $carts->where('abandoned_cart', '!=', 0)->where('abandoned_cart', 2)
            ->whereHas('product_stock', function ($query) {
                $query->where('product_stocks.qty','>','0')
                    ->whereRaw('`carts`.`variation` = `product_stocks`.`variant`');
            })
            ->get();

        return $carts;
    }

    public function StockOutCartList(){

//        $mytime = Carbon::yesterday();
        $carts = Cart::whereNotNull('user_id')
//            ->where('updated_at', '<', $mytime)
            ->where('abandoned_cart', '!=', 2)
            ->select('id','user_id','product_id','variation','quantity','price','abandoned_cart','updated_at')
            ->whereHas('user', function ($query) {
                $query->select('id')
                    ->whereNotNull('email')
                    ->where('user_type','customer')
                    ->where('subscribed',1)
                    ->whereNotNull('email_verified_at');
            })
//            ->with('user:id,name,email,phone')
            ->whereHas('product_stock', function ($query) {
                $query->where('product_stocks.qty','=','0')
                    ->whereRaw('`carts`.`variation` = `product_stocks`.`variant`');
            })
//            ->with('product:id,name,thumbnail_img')
//            ->with('product_stock')
            ->orderBy('id', 'DESC')
            ->get();
        return $carts;
    }

    public function index(Request $request, $key)
    {

        if ($key == "execute_abc"){


            $stockOutCartlist = $this->StockOutCartList();
            foreach ($stockOutCartlist as $key=> $stockOutCart) {
                $stockOutCart->abandoned_cart = 2;
                $stockOutCart->save();
            }

            $cartlist = $this->getCartList();
            $carts = array();
            foreach ($cartlist as $key=> $c) {
                $carts[$c->user_id][$key] = $c;
            }
            foreach ($carts as $cart){
                $this->abandonedCartEmail(array_values($cart));
            }

            $restockCartlist = $this->restockCartList();
            $restockCarts = array();
            foreach ($restockCartlist as $key=> $c) {
                $restockCarts[$c->user_id][$key] = $c;
            }
            foreach ($restockCarts as $cart){
                $this->restockCartEmail(array_values($cart));
            }
            return 1;
        }

        return 0;

    }

    public function abandonedCartEmail($carts)
    {
        foreach ($carts as $key=> $cart) {
            $cart->abandoned_cart = 0;
            $cart->save();
        }

        if (env('MAIL_USERNAME') != null ) {
            $array['view'] = 'emails.abandoned_cart';
            $array['subject'] = 'We\'re holding the items in your cart for you';
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['carts'] = $carts;
            try {
                    Mail::to($carts[0]->user->email)->queue(new AbandonedCartEmailManager($array));
//                dd("email done", $carts);

            } catch (\Exception $e) {
//                return dd("email not sent",$e);
            }
        }
        return 1;
    }


    public function restockCartEmail($carts)
    {
        foreach ($carts as $key=> $cart) {
            $cart->abandoned_cart = 0;
            $cart->save();
        }

        if (env('MAIL_USERNAME') != null ) {
            $array['view'] = 'emails.backInStock_cart';
            $array['subject'] = 'Look what’s FINALLY BACK!';
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['carts'] = $carts;
            try {
                    Mail::to($carts[0]->user->email)->queue(new AbandonedCartEmailManager($array));
//                dd("email done 2");
            } catch (\Exception $e) {
            }
        }

        return 1;
    }


}

