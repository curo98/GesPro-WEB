<?php

namespace App\Models\ux;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    protected $fillable = ['name', 'description', 'uri', 'exact_location', 'destination_id'];

    // Definir la relación inversa de Many-to-One con la tabla destinations
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
