<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'remember_token'
    ];

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function sensor_readings()
    {
        return $this->hasMany(SensorReading::class);
    }
}
