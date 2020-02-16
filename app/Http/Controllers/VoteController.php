<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Models\Video;

class VoteController extends Controller
{
    public function toggle(Video $video, $type)
    {
        return auth()->user()->toggleVote($video, $type);
    }
}
