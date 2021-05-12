<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'platform_id',
        'project_id',
        'origin_id',
        'user_id',
        'is_appointment',
        'is_add_wechat',
        'is_to_store',
        'achievement',
        'appointment_time',
        'note',
        'state'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    // 多对一：多个患者属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 一对多：一个患者拥有多条回访
    public function repays()
    {
        return $this->hasMany(Repay::class, 'patient_id', 'id');
    }

    // 多对一：多个患者属于一个来源
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    // 多对一：多个患者属于一个平台
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    // 多对一：多个患者属于一个项目
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
