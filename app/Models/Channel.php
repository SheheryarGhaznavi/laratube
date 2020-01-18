<?php

namespace Laratube\Models;

use Laratube\GeneralModel;
use Laratube\User;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Channel extends GeneralModel implements HasMedia
{
    ///////// Package For Media /////////
    use HasMediaTrait;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        if ($this->media->first()) {
            return $this->media->first()->getFullUrl('thumb');
        }
        return "https://img.icons8.com/ios/64/000000/camera.png";
    }

    public function editable()
    {
        if (!auth()->check())   return false;

        return $this->user_id == auth()->user()->id;
    }

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
        ->width('100')
        ->height('100');
    }
}
