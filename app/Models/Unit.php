<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($unit) {
            $unit->slug = Str::slug($unit->name);
        });

        static::updating(function ($unit) {
            $unit->slug = Str::slug($unit->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
