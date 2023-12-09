<?php

namespace App\Models\ux;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    use HasFactory;

    protected $table = 'tourist_spots';
    protected $fillable = ['name', 'description', 'uri', 'destination', 'exact_location'];
}
