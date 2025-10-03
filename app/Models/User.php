<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   
    use HasFactory, Notifiable;    
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'status',
        'user_type_uuid',
        'visitor_uuid',
        'teacher_uuid',
        'password_verified_code',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
   
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userType () {
        return $this->belongsTo(UserType::class);
    }

    public function visitor () {
        return $this->belongsTo(Visitor::class);
    }

    public function teacher () {
        return $this->belongsTo(Teacher::class);
    }

    public function userPersonalData () {
        return $this->belongsTo(PersonalData::class, 'visitor_uuid', 'visitor_uuid');
    }

}
