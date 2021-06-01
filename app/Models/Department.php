<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // 子部门
    public function child()
    {
        return $this->hasMany(Department::class, 'parent_id', 'id');
    }

    // 递归所有子部门
    public function children()
    {
        return $this->child()->with('children');
    }
}
