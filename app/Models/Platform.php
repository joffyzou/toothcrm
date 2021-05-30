<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    // 一对多：一个平台拥有多个患者
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    // 多对一：多个平台属于一个运营
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['username' => '未分配']);
    }
}
