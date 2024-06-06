<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTag extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'tag_id',
        'product_id'
    ];

    public function Tags(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function Product(): BelongsTo
    {
        //changeWhenProductAdd change State to Product
        return $this->belongsTo(State::class);
        //
    }
}
