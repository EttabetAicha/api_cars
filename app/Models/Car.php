<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand',
        'model',
        'mileage',
        'registration_date',
        'power',
        'fuel',
        'engine',
        'options',
    ];

    /**
     * Get the users that own the car.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
