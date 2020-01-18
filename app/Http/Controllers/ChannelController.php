<?php

namespace Laratube\Http\Controllers;

use Laratube\Models\Channel;
use Illuminate\Http\Request;
use Laratube\Http\Requests\Channel\Update;

class ChannelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('update');
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laratube\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('channels.show',compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Laratube\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laratube\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Channel $channel)
    {
        $image = "";
        ///////////// If File Exists then Save It /////////////
        if ($request->hasFile('image')) {

            /////////// Clear all images in this channel /////////
            $channel->clearMediaCollection('images');

            /////////// Add new Uploaded image /////////
            $channel->addMediaFromRequest('image')->toMediaCollection('images');

            $image.= "with Image";
        }



        //////////// Update Channel In Database /////////////
        $channel->name = request('name');
        $channel->description = request('description');
        $channel->save();


        $message = "Channel Updated ".$image;

        return redirect(route('channel.show',$channel->id))->with('status',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Laratube\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
