<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Http\Requests\Video\Update;
use Laratube\Models\Video;

class VideoController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        if (request()->wantsJson()) {
            return $video;
        } else {
            return view('videos.show',compact('video'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Video $video)
    {
        $video->title = $request->title;
        $video->description = $request->description;
        $video->save();

        return redirect()->back()->with('success','Video Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view(Video $video)
    {
        $video->increment('view');
        return response()->json([]);
    }
}
