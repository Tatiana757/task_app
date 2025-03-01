<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public static function getIdBySlug($slug)
    {
        return self::where('slug', $slug)->value('id');
    }
}
