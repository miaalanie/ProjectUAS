<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HeartRateFuzzy
 * 
 * @property int $id
 * @property int|null $min
 * @property int|null $max
 * @property string $label
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class HeartRateFuzzy extends Model
{
	protected $table = 'heart_rate_fuzzy';

	protected $casts = [
		'min' => 'int',
		'max' => 'int'
	];

	protected $fillable = [
		'min',
		'max',
		'label'
	];
}
