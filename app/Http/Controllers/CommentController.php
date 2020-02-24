<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Models\Comment;
use Laratube\Models\Video;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    public function index(Video $video) {
        return $video->comment()->paginate(5);
    }

    public function getReply(Comment $comment) {
        return $comment->reply()->paginate(5);
    }
    public function store(Request $request, Video $video)
    {
        return auth()->user()->comment()->create([
            'body' => $request->body,
            'video_id' => $video->id,
            'comment_id' => ( $request->comment_id ? $request->comment_id : null ) 
        ])->fresh();
    }


}
