<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Guest
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Diagnosis[] $diagnoses
 *
 * @package App\Models
 */
class Guest extends Model
{
	protected $table = 'guests';

	protected $fillable = [
		'name'
	];

	public function diagnoses()
	{
		return $this->hasMany(Diagnosis::class, 'user_id');
	}
}
