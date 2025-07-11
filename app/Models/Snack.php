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
 * Class Snack
 * 
 * @property int $id
 * @property string $nama_snack
 * @property string|null $foto_snack
 * @property string $kandungan_gizi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Diagnosis[] $diagnoses
 * @property Collection|Mood[] $moods
 *
 * @package App\Models
 */
class Snack extends Model
{
	use SoftDeletes;
	protected $table = 'snacks';

	protected $fillable = [
		'nama_snack',
		'foto_snack',
		'kandungan_gizi'
	];

	public function diagnoses()
	{
		return $this->hasMany(Diagnosis::class);
	}

	public function moods()
	{
		return $this->belongsToMany(Mood::class)
					->withPivot('id')
					->withTimestamps();
	}
}
