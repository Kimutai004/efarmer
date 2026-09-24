<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoatPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'goat_id',
        'path',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function goat()
    {
        return $this->belongsTo(Goat::class);
    }
}