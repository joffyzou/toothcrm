<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    // 一对一 部门
    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id')->withDefault(['name' => '-']);
    }

    // 一对多：一个运营可以管理多个平台
    public function platform()
    {
        return $this->hasMany(Platform::class);
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

    public function scopeOperater($query)
    {
        return $query->where('department_id', 2);
    }
}
