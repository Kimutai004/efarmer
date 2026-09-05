<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tag_number',
        'name',
        'breed_id',
        'category',
        'gender',
        'date_of_birth',
        'color',
        'weight',
        'purchase_price',
        'selling_price',
        'status',
        'location',
        'description',
        'featured',
        'sold_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'sold_at' => 'datetime',
        'featured' => 'boolean',
        'weight' => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function photos()
    {
        return $this->hasMany(GoatPhoto::class);
    }

    public function primaryPhoto()
    {
        return $this->hasOne(GoatPhoto::class)->where('is_primary', true);
    }

    public function healthRecords()
    {
        return $this->hasMany(GoatHealthRecord::class)
            ->latest('record_date');
    }

    public function weightRecords()
    {
        return $this->hasMany(GoatWeightRecord::class)
            ->latest('recorded_at');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getPrimaryPhotoAttribute()
    {
        return $this->photos()
            ->where('is_primary', true)
            ->first()
            ?? $this->photos()->first();
    }
}