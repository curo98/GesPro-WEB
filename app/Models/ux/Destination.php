<?php

namespace App\Models\ux;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function touristSpots()
    {
        return $this->hasMany(TouristSpot::class);
    }

    public function fares()
    {
        return $this->hasMany(Fare::class);
    }
}
