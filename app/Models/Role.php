<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function nodes()
    {
        // $role->nodes 角色下的权限
        return $this->belongsToMany(Node::class, 'role_node', 'role_id', 'node_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
