<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Models\Video;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comment()->paginate(5);
    }
}
