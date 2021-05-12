<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    // 一对多：一个项目拥有多个患者
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
