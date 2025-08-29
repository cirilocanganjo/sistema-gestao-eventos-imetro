<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';  
    protected $fillable = [
        'event_name',
        'event_description',
        'event_highlighted',
        'event_category_uuid',
        'event_cover_photo',
        'user_id'
    ];

    public function event_category () {
        return $this->belongsTo(EventCategory::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
