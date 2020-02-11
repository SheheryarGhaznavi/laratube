<?php

namespace Laratube\Models;

use Laratube\GeneralModel;
use Laratube\User;

class Comment extends GeneralModel
{
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(Comment::class,'comment_id')->whereNotNull('comment_id');
    }
}
