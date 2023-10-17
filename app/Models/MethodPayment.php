<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function supplierRequests()
    {
        return $this->belongsTo(SupplierRequest::class, 'id');
    }
}
