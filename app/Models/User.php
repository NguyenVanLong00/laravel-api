<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Common\Paginate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use Paginate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Start Scopes
     */

    public function scopeFilter(Builder $builder, array $params)
    {

        $builder
            ->when(Arr::get($params, 'name'), function ($query, $name) {
                $query->where('name', $name);
            })
            ->when(Arr::get($params, 'username'), function ($query, $value) {
                $query->where('email', $value);
            })
            ->when(Arr::get($params, 'role'), function ($query, $value) {
                $query->whereHas('roles',fn($q) => $q->where('name', $value));
            })
            ->when(Arr::get($params, 'permission'), function ($query, $value) {
                $query->whereHas('roles.permissions',fn($q) => $q->where('name', $value));
            });
    }

    /**
     * End Scopes
     */


}
