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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repays()
    {
        return $this->hasMany(repay::class, 'patient_id', 'id');
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
