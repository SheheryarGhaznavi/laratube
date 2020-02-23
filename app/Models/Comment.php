<?php

namespace Laratube\Models;

use Laratube\GeneralModel;
use Laratube\User;

class Comment extends GeneralModel
{
    protected $with = ['user:id,name', 'vote'];
    protected $appends = ['replyCount'];

    public function video() {
        return $this->belongsTo(Video::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getReplyCountAttribute() {
        return $this->reply->count();
    }

    public function vote(){
        return $this->morphMany(Vote::class,'voteable');
    }

    public function reply(){
        return $this->hasMany(Comment::class,'comment_id')->whereNotNull('comment_id');
    }
}
