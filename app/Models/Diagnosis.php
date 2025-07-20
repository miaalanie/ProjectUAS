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
 * @property float $suhu
 * @property float $detak_jantung
 * @property float $hasil_fuzzy
 * @property string $mood
 * @property int|null $snack_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Mood $mood
 * @property Snack|null $snack
 * @property Guest $user
 *
 * @package App\Models
 */
class Diagnosis extends Model
{
	use SoftDeletes;
	protected $table = 'diagnoses';

	protected $casts = [
		'user_id' => 'int',
		'suhu' => 'float',
		'detak_jantung' => 'float',
		'hasil_fuzzy' => 'float',
		'mood' => 'string',
		'snack_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'suhu',
		'detak_jantung',
		'hasil_fuzzy',
		'mood',
		'snack_id'
	];

	
	   public function snack()
	   {
			   return $this->belongsTo(Snack::class);
	   }

	   // Relasi ke Guest (bukan User), sesuai migration foreign key
	   public function guest()
	   {
			   return $this->belongsTo(Guest::class, 'user_id');
	   }
}
