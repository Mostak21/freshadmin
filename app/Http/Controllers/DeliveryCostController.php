<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAgent;
use App\Models\DeliveryCost;
use Illuminate\Http\Request;

class DeliveryCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $DeliveryCost_queries = DeliveryCost::query();
        $costs = $DeliveryCost_queries->orderBy('name', 'asc')->paginate(10);
        return view('backend.setup_configurations.costs.index', compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cost = new DeliveryCost();

        $cost->city_id = $request->city_id;
        $cost->delivery_agent_id = $request->delivery_agent_id;
        $cost->time = $request->time;
        $cost->cost = $request->cost;

        $cost->save();

        flash(translate('City has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryCost  $deliveryCost
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCost $deliveryCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryCost $deliveryCost
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCost $deliveryCost, Request $request, $id )
    {
        //
//        $lang  = $request->lang;
//        $cost  = DeliveryCost::findOrFail($id);
//
//        return view('backend.setup_configurations.costs.edit', compact('cost'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryCost $deliveryCost
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, DeliveryCost $deliveryCost, $id)
    public function update(Request $request, $id)
    {
        $cost = DeliveryCost::findOrFail($id);

        if (empty($request->time)|| empty($request->cost)){
            $this->destroy($id);
        }

        $cost->city_id  = $request->city_id;
        $cost->time     = $request->time;
        $cost->cost     = $request->cost;
        $cost->delivery_agent_id = $request->delivery_agent_id;

        $cost->save();

        flash(translate('Delivery Cost has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryCost $deliveryCost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DeliveryCost::destroy($id);

        flash(translate('Delivery Cost has been deleted successfully'))->success();
        return back();
    }

    public function updateStatus(Request $request){


        if(DeliveryCost::find($request->id)){
            $cost = DeliveryCost::findOrFail($request->id);
            $cost->status = $request->status;
            $cost->save();

            $data[0]=1;
            $data[1]=$cost->id;

            return $data;
        }
        else{
            $cost = new DeliveryCost();

            $agent = DeliveryAgent::where('id', $request->agent)->first();

            $cost->city_id = $request->city;
            $cost->delivery_agent_id = $agent->id;
            $cost->time = $agent->time;
            $cost->cost = $agent->cost;
            $cost->status = $request->status;

            $cost->save();

            $data[0]=1;
            $data[1]=$cost->id;

            return $data;
        }
    }

    public function save(DeliveryCost $deliveryCost, Request $request, $id )
    {
        if(DeliveryCost::find($id)){
            $this->update($request,$id);
        }
        else{
          $exist = DeliveryCost::where('city_id', $request->city_id)->where('delivery_agent_id', $request->delivery_agent_id)->first();

          if ($exist){
            $this->update($request,$exist->id);
          }
          else{
            $this->store($request,$id);
          }
        }

        return back();
    }
}
