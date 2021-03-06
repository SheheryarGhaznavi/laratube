<?php

namespace Laratube;

use Laratube\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratube\Models\Comment;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function toggleVote($entity, $type)
    {
        $vote = $entity->vote->where('user_id',$this->id)->first();

        if ($vote) {
            $vote->type = $type;
            $vote->save();
            return $vote->refresh();
        } else {
            return $entity->vote()->create([
                'user_id' => $this->id,
                'type' => $type
            ]);
        }
        
    }
}
