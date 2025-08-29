<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TemporaryInvitationEvent extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';  
    protected $fillable = ['event_uuid'];

    public function event () {
        return $this->belongsTo(Event::class);
    }
}
