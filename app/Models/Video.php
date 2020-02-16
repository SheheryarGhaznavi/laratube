<?php

namespace Laratube\Models;

use Laratube\GeneralModel;

class Video extends GeneralModel
{
    protected $fillable = [
        'title','path'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function editable()
    {
        return auth()->check() && auth()->user()->id === $this->channel->user_id;
    }

    public function vote()
    {
        return $this->morphMany(Vote::class,'voteable');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }
}
