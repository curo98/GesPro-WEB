<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_supplier',
        'name',
        'uri',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // public function supplierRequests()
    // {
    //     return $this->belongsToMany(SupplierRequest::class, 'supplier_requests_documents');
    // }

    public function supplierRequests()
    {
        return $this->belongsToMany(SupplierRequest::class, 'supplier_requests_documents', 'id_documents', 'id_supplier_request');
    }
}
