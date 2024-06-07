<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ProductImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /** @noinspection PhpUnused */
    public function ProductQuantities(): HasMany
    {
        return $this->hasMany(ProductQuantity::class, 'product_id');
    }
}
