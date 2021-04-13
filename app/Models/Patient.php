<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pid',
        'phone',
        'admin_id',
        'is_appointment',
        'is_add_wechat',
        'project',
        'is_to_store',
        'achievement',
        'note'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
