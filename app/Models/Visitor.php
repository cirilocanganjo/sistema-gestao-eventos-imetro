<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';  
    protected $fillable = ['visitor_type_uuid'];   

    public function visitor_type () {
        return $this->belongsTo(VisitorType::class);
    }
}
