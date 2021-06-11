<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repay extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'repay'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    // 多对一：多条回访属于一个患者
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
