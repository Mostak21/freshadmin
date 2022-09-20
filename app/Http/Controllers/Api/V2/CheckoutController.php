<?php


namespace App\Http\Controllers\Api\V2;


use App\Models\Coupon;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;
use App\Models\DeliveryAgent;
use App\Models\DeliveryCost;
use App\Http\Resources\DeliveryCollection;

class CheckoutController
{
    public function store_shipping_info(Request $request)
    {
        $cart=Cart::where('user_id',$request->user_id)->first();

        $city = Address::where('id', $cart->address_id)->first();
        $agents = DeliveryAgent::get();
        $agent_costs = DeliveryCost::where('city_id',$city->city_id)->get();
        foreach ($agents as $key => $agent){
            if ($agent_costs){
                foreach ($agent_costs as $key2 => $cost){
                    if ($agent->id == $cost->delivery_agent_id && $cost->status == 0 || $agent->status == 0 ){
                        unset($agents[$key]);
                    }
                    elseif ($agent->id == $cost->delivery_agent_id && $cost->status == 1){
                        $agents[$key]->cost = $cost->cost;
                        $agents[$key]->time = $cost->time;
                    }
                }
            }
        }

        $agents = $agents->values();

        return new DeliveryCollection($agents);
        // dd($agents);

        // return view('frontend.delivery_info', compact('carts','agents'));
        // return view('frontend.payment_select', compact('total'));
    }


    public function apply_coupon_code(Request $request)
    {
        $cart_items = Cart::where('user_id', $request->user_id)->get();
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if ($cart_items->isEmpty()) {
            return response()->json([
                'result' => false,
                'message' => translate('Cart is empty')
            ]);
        }

        if ($coupon == null) {
            return response()->json([
                'result' => false,
                'message' => translate('Invalid coupon code!')
            ]);
        }

        $in_range = strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date;

        if (!$in_range) {
            return response()->json([
                'result' => false,
                'message' => translate('Coupon expired!')
            ]);
        }

        $is_used = CouponUsage::where('user_id', $request->user_id)->where('coupon_id', $coupon->id)->first() != null;

        if ($is_used) {
            return response()->json([
                'result' => false,
                'message' => translate('You already used this coupon!')
            ]);
        }


        $coupon_details = json_decode($coupon->details);

        if ($coupon->type == 'cart_base') {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            foreach ($cart_items as $key => $cartItem) {
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $shipping += $cartItem['shipping'] * $cartItem['quantity'];
            }
            $sum = $subtotal + $tax + $shipping;

            if ($sum >= $coupon_details->min_buy) {
                if ($coupon->discount_type == 'percent') {
                    $coupon_discount = ($sum * $coupon->discount) / 100;
                    if ($coupon_discount > $coupon_details->max_discount) {
                        $coupon_discount = $coupon_details->max_discount;
                    }
                } elseif ($coupon->discount_type == 'amount') {
                    $coupon_discount = $coupon->discount;
                }

                Cart::where('user_id', $request->user_id)->update([
                    'discount' => $coupon_discount / count($cart_items),
                    'coupon_code' => $request->coupon_code,
                    'coupon_applied' => 1
                ]);

                return response()->json([
                    'result' => true,
                    'message' => translate('Coupon Applied')
                ]);


            }
        } elseif ($coupon->type == 'product_base') {
            $coupon_discount = 0;
            foreach ($cart_items as $key => $cartItem) {
                foreach ($coupon_details as $key => $coupon_detail) {
                    if ($coupon_detail->product_id == $cartItem['product_id']) {
                        if ($coupon->discount_type == 'percent') {
                            $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                        } elseif ($coupon->discount_type == 'amount') {
                            $coupon_discount += $coupon->discount;
                        }
                    }
                }
            }


            Cart::where('user_id', $request->user_id)->update([
                'discount' => $coupon_discount / count($cart_items),
                'coupon_code' => $request->coupon_code,
                'coupon_applied' => 1
            ]);

            return response()->json([
                'result' => true,
                'message' => translate('Coupon Applied')
            ]);

        }


    }

    public function remove_coupon_code(Request $request)
    {
        Cart::where('user_id', $request->user_id)->update([
            'discount' => 0.00,
            'coupon_code' => "",
            'coupon_applied' => 0
        ]);

        return response()->json([
            'result' => true,
            'message' => translate('Coupon Removed')
        ]);
    }
}
