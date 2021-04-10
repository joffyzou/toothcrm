<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function nodes(){
        return $this->belongsToMany(Node::class, 'role_node', 'role_id', 'node_id');
    }
}
