<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoatHealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'goat_id',
        'record_type',
        'title',
        'description',
        'veterinarian',
        'record_date',
        'next_due_date',
        'cost',
    ];

    protected $casts = [
        'record_date' => 'date',
        'next_due_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function goat()
    {
        return $this->belongsTo(Goat::class);
    }
}