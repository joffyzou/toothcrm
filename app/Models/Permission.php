<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    // 子权限
    public function child()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }

    // 递归所有子权限
    public function children()
    {
        return $this->child()->with('children');
    }
}
