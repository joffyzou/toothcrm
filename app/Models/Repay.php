<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repay extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'patient_id',
        'repay'
    ];
}
