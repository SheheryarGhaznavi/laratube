<?php

namespace Laratube\Http\Controllers;

use Laratube\Models\Subscription;
use Illuminate\Http\Request;
use Laratube\Models\Channel;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Channel $channel)
    {
        $channel->subscription()->create([
            'user_id' => auth()->user()->id
        ]);
        return response()->json($channel->subscription);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laratube\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Laratube\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laratube\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Laratube\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel,Subscription $subscription)
    {
        $subscription->delete();
        return response()->json($channel->subscription);
    }
}
