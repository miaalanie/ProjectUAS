<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SensorReading
 * 
 * @property int $id
 * @property int $user_id
 * @property float $suhu
 * @property int $detak_jantung
 * @property Carbon $recorded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Diagnosis[] $diagnoses
 *
 * @package App\Models
 */
class SensorReading extends Model
{
	use SoftDeletes;
	protected $table = 'sensor_readings';

	protected $casts = [
		'user_id' => 'int',
		'suhu' => 'float',
		'detak_jantung' => 'int',
		'recorded_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'suhu',
		'detak_jantung',
		'recorded_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function diagnoses()
	{
		return $this->hasMany(Diagnosis::class);
	}
}
