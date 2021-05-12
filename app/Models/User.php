<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'role_id',
        'p_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 多对一：多个用户对应一个角色
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // 一对多：一个用户拥有多个患者
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function feed()
    {
        return $this->patients()->orderBy('created_at', 'desc');
    }

    // 一对多：一个用户写了多条回访
    public function repays()
    {
        return $this->hasMany(Repay::class);
    }
}
