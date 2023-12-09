<?php

namespace App\Models\ux;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    public function fares()
    {
        return $this->hasMany(Fare::class);
    }
}
