<?php

namespace App\Models;

use App\Http\Livewire\Idlog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;

    /**
     * USER's ROLE
     */
    const HEAD   = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function office()
    {
        if ($this->hasRole('office-head')) {
            return $this->hasOne(Office::class);
        }

        return null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function available()
    {
        return $this->hasOne(AvailableId::class);
    }

    public function idLog()
    {
        return $this->hasOne(Idlog::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeSearch($query, $terms)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%' . $term . '%';

            $query->where(function ($query) use ($term) {
                $query->where('fname', 'like', $term)->orWhere('lname', 'like', $term);
            });
        });
    }
}
