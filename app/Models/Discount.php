<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'value',
        'min_purchase',
        'valid_from',
        'valid_until'
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];
}
