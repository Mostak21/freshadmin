<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\AddressCollection;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DeliveryAgent;
use App\Models\DeliveryCost;
use GrahamCampbell\ResultType\Success;

class ShippingController extends Controller
{
    public function shipping_cost(Request $request)
    {
        $carts = Cart::where('user_id', $request->user_id)
            ->get();

        foreach ($carts as $key => $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }

        $carts = Cart::where('user_id', $request->user_id)
            ->get();
        foreach ($carts as $key => $cartItem) {
            //$cartItem['shipping_cost'] = getShippingCost($carts, $key);
            $cartItem['shipping_cost'] = getShippingCost($carts, $key,$cartItem['shipping_type'],null);
            $cartItem->save();
        }

        //Total shipping cost $calculate_shipping

        $total_shipping_cost = Cart::where('user_id', $request->user_id)->sum('shipping_cost');

        return response()->json(['result' => true, 'shipping_type' => get_setting('shipping_type'), 'value' => convert_price($total_shipping_cost), 'value_string' => format_price($total_shipping_cost)], 200);
    }


    public function deliveryagentcost(Request $request){

        $carts = Cart::where('user_id', $request->user_id)
        ->get();
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
    foreach ($carts as $key => $cartItem) {

        $agent_costs = DeliveryAgent::where('id',$request->shipping_method)->first();
        $cartItem['shipping_method'] = $agent_costs->name;
        $cartItem['shipping_type'] = 'delivery_agent';

        $delivery_agent_cost = DeliveryCost::where('city_id',$shipping_info['city']->id)->where('delivery_agent_id',$agent_costs->id)->first();
        if ($delivery_agent_cost!=null){
            $agent_costs = $delivery_agent_cost;
            if ($agent_costs->status==0){
                flash(translate('Something went wrong'))->error();
                return redirect()->route('checkout.shipping_info');
            }
        }
        $cartItem['shipping_cost'] = getShippingCost($carts, $key,$cartItem['shipping_type'],$agent_costs);

        //$cartItem['shipping_cost'] = getShippingCost($carts, $key);
        // $cartItem['shipping_cost'] = getShippingCost($carts, $key,$cartItem['shipping_type'],null);
        $cartItem->save();

       

    }
    return response()->json([
        'result' => true,
        'message' => 'Success',
    ]);


    }
}
