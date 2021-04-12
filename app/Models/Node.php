<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route_name',
        'pid'
    ];

    public function getAllList()
    {
        $data = self::get()->toArray();

        retrun $data;
    }
}
