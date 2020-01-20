<?php

namespace Laratube\Models;

use Laratube\GeneralModel;

class Video extends GeneralModel
{
    protected $fillable = [
        'title','path'
    ];
}
