<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BodyTemperatureFuzzy
 * 
 * @property int $id
 * @property float|null $min
 * @property float|null $max
 * @property string $label
 * @property string|null $source
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class BodyTemperatureFuzzy extends Model
{
	protected $table = 'body_temperature_fuzzy';

	protected $casts = [
		'min' => 'float',
		'max' => 'float'
	];

	protected $fillable = [
		'min',
		'max',
		'label',
		'source'
	];
}
