<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // 一对多：一个角色拥有多个用户
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
