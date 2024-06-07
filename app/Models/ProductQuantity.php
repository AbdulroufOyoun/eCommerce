<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductQuantity extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'range_from',
        'range_to',
        'price_per_unit',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
