<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasUuids, SoftDeletes, HasApiTokens, HasRoles, HasPermissions;

    protected $fillable = [
        'created_by',
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    protected static function boot()
//    {
//        parent::boot(); // TODO: Change the autogenerated stub
//
//        static::creating(function ($model) {
//            $model->setSuperAttribute();
//        });
//
//    }
//
//    public function setSuperAttribute()
//    {
//        $this->attributes['created_by'] = \auth('Admin')->user()->id;
//    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function Admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /** @noinspection PhpUnused */
    public function Categories(): HasMany
    {
        return $this->hasMany(Category::class, 'admin_id');
    }

    /** @noinspection PhpUnused */
    public function BinderyAttributes(): HasMany
    {
        return $this->hasMany(BinderyAttribute::class, 'admin_id');
    }

    public function NormalAttributes(): HasMany
    {
        return $this->hasMany(NormalAttribute::class, 'admin_id');
    }
}
