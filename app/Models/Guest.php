<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Guest extends Model
{
    use SoftDeletes;

    protected $table = 'guests';

    protected $fillable = [
        'name',
        // tambahkan field lain jika diperlukan, misal: 'email', 'gender', 'age'
    ];

    /**
     * Relasi: Guest hasMany Diagnosis
     * Pastikan foreign key di tabel diagnoses adalah guest_id
     */
    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'guest_id');
    }

    /**
     * @property int $id
     * @property string $name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     */
}
