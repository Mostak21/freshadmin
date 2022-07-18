<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAgent;
use Illuminate\Http\Request;

class DeliveryAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $DeliveryAgent_queries = DeliveryAgent::query();
        $agents = $DeliveryAgent_queries->orderBy('name', 'asc')->paginate(10);
        return view('backend.setup_configurations.agents.index', compact('agents'));
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
        $agent = new DeliveryAgent();

        $agent->name = $request->name;
        $agent->cost = $request->cost;
        $agent->time = $request->time;
        $agent->info = $request->info;

        $agent->save();

        flash(translate('City has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryAgent  $deliveryAgent
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryAgent $deliveryAgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryAgent  $deliveryAgent
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryAgent $deliveryAgent, Request $request, $id )
    {
        //
//        $lang  = $request->lang;
        $agent  = DeliveryAgent::findOrFail($id);

        return view('backend.setup_configurations.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryAgent  $deliveryAgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryAgent $deliveryAgent, $id)
    {
        $agent = DeliveryAgent::findOrFail($id);

        $agent->name = $request->name;
        $agent->time = $request->time;
        $agent->cost = $request->cost;
        $agent->info = $request->info;

        $agent->save();

        flash(translate('Delivery Agent has been updated successfully'))->success();
        return back();
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryAgent  $deliveryAgent
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryAgent $deliveryAgent, $id)
    {
        //

        DeliveryAgent::destroy($id);

        flash(translate('Delivery Agent has been deleted successfully'))->success();
        return redirect()->route('agents.index');
    }

    public function updateStatus(Request $request){
        $agent = DeliveryAgent::findOrFail($request->id);
        $agent->status = $request->status;
        $agent->save();

        return 1;
    }
}
