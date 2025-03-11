<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'unit_id', 'code', 'name', 'price', 'stock'];

    public function setCodeAttribute($value)
    {
        if (!$this->exists) {
            $this->attributes['code'] = $value;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }
}
