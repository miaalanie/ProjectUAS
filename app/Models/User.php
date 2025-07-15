<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> b1c08ebb95de43ab8a645a45119ceb8cfc37a380
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Diagnosis[] $diagnoses
 * @property Collection|SensorReading[] $sensor_readings
 *
 * @package App\Models
 */
<<<<<<< HEAD
class User extends Authenticatable // ✅ ganti Model -> Authenticatable
=======
class User extends Model
>>>>>>> b1c08ebb95de43ab8a645a45119ceb8cfc37a380
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