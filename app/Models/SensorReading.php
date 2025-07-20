<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SensorReading
 * 
 * @property int $id
 * @property float $suhu
 * @property int $detak_jantung
 * @property Carbon $recorded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class SensorReading extends Model
{
	use SoftDeletes;
	protected $table = 'sensor_readings';

	protected $casts = [
		'recorded_at' => 'datetime'
	];

	protected $fillable = [
		'suhu',
		'detak_jantung',
		'recorded_at'
	];

	
}
