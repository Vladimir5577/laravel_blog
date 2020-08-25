<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * Оценки, которые поставил пользователь
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function putRates()
    {
        return $this->hasMany(Rating::class, 'user_author');
    }

    /**
     * Оценки пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(Rating::class, 'user_recipient_rate');
    }

    /**
     * comment section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_recipient_comment');

    }



}
