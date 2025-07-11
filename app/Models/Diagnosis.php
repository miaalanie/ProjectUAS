<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Diagnosis
 * 
 * @property int $id
 * @property int $user_id
 * @property int $sensor_reading_id
 * @property float $hasil_fuzzy
 * @property int $mood_id
 * @property int|null $snack_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Mood $mood
 * @property SensorReading $sensor_reading
 * @property Snack|null $snack
 * @property User $user
 *
 * @package App\Models
 */
class Diagnosis extends Model
{
	use SoftDeletes;
	protected $table = 'diagnoses';

	protected $casts = [
		'user_id' => 'int',
		'sensor_reading_id' => 'int',
		'hasil_fuzzy' => 'float',
		'mood_id' => 'int',
		'snack_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'sensor_reading_id',
		'hasil_fuzzy',
		'mood_id',
		'snack_id'
	];

	public function mood()
	{
		return $this->belongsTo(Mood::class);
	}

	public function sensor_reading()
	{
		return $this->belongsTo(SensorReading::class);
	}

	public function snack()
	{
		return $this->belongsTo(Snack::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
