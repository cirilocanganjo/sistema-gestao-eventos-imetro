<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppDetail extends Model
{
    protected $fillable = [
        'app_name',
        'user_id'
    ];
}
