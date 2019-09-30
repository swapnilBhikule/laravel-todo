<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    	'user_id', 'task', 'is_complete'
    ];

    public $timestamps = true;
}
