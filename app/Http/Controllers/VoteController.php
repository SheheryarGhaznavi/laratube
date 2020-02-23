<?php

namespace Laratube\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laratube\Models\Comment;
use Laratube\Models\Video;

class VoteController extends Controller
{
    public function toggle($entiyId, $type)
    {
        $entity = $this->getEntity($entiyId);
        return auth()->user()->toggleVote($entity, $type);
    }

    public function getEntity($entiyId)
    {
        $video = Video::find($entiyId);
        if ($video) {
            return $video;
        }

        $comment = Comment::find($entiyId);
        if ($comment) {
            return $comment;
        }

        throw new ModelNotFoundException('Entity Not Found');
    }
}
