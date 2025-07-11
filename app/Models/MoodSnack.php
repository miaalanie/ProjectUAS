<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MoodSnack
 * 
 * @property int $id
 * @property int $mood_id
 * @property int $snack_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Mood $mood
 * @property Snack $snack
 *
 * @package App\Models
 */
class MoodSnack extends Model
{
	protected $table = 'mood_snack';

	protected $casts = [
		'mood_id' => 'int',
		'snack_id' => 'int'
	];

	protected $fillable = [
		'mood_id',
		'snack_id'
	];

	public function mood()
	{
		return $this->belongsTo(Mood::class);
	}

	public function snack()
	{
		return $this->belongsTo(Snack::class);
	}
}
