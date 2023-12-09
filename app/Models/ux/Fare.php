<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    // Relaciones
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
