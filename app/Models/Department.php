<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

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
