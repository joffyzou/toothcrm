<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_id',
        'platform',
        'phone',
        'admin_id',
        'is_appointment',
        'is_add_wechat',
        'project',
        'is_to_store',
        'achievement',
        'repay',
        'appointment_time',
        'note',
        'origin'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
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
