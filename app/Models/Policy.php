<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function requests() {
        return $this->belongsToMany(SupplierRequest::class,  'supplier_requests_policies',  'id_supplier_request', 'id_policie')
            ->withPivot('aceepted');
    }
}
