<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    private const ROLES_HIERARCHY = [
        self::ROLE_SUPERADMIN => [self::ROLE_ADMIN, self::ROLE_USER],
        self::ROLE_ADMIN => [self::ROLE_USER],
        self::ROLE_USER => []
    ];

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
    public function getJWTIdentifier()

    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->as('suscriptions')->withTimestamps();
    }
    public function isGranted($role)
    {
        return $role === $this->role || in_array($role, self::ROLES_HIERARCHY[$this->role]);
    }
    public function userable()
    {
        return $this->morphTo();
    }

}
