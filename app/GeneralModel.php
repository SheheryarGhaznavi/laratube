<?php

namespace Laratube;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class GeneralModel extends Model
{
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
