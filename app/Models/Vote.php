<?php

namespace Laratube\Models;

use Laratube\GeneralModel;

class Vote extends GeneralModel
{
    protected $fillable = [
        'user_id'
    ];

    public function voteable()
    {
        return $this->morphTo();
    }
}
