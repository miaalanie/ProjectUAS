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
 * Class Mood
 * 
 * @property int $id
 * @property string $jenis_mood
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Diagnosis[] $diagnoses
 * @property Collection|Snack[] $snacks
 *
 * @package App\Models
 */
class Mood extends Model
{
	use SoftDeletes;
	protected $table = 'moods';

	protected $fillable = [
		'jenis_mood',
		'keterangan'
	];

	public function diagnoses()
	{
		return $this->hasMany(Diagnosis::class);
	}

	public function snacks()
	{
		return $this->belongsToMany(Snack::class)
					->withPivot('id')
					->withTimestamps();
	}
}
