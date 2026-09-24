<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoatWeightRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'goat_id',
        'weight',
        'recorded_at',
        'notes',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'recorded_at' => 'date',
    ];

    public function goat()
    {
        return $this->belongsTo(Goat::class);
    }
}