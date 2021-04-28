<?php

namespace App\Models;

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

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
