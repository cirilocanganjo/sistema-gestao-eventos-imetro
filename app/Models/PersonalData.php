<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';    
    protected $fillable = [
        'full_name',
        'phone',
        'identity_card',
        'gender',
        'teacher_uuid',
        'visitor_uuid',
    ];
}
