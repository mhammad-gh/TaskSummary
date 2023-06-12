<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    public $fillable = [
        'task_id',
        'type',
        'time'
    ];
}
