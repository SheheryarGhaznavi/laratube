<?php

namespace Laratube\Models;

use Laratube\GeneralModel;

class Channel extends GeneralModel
{
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
