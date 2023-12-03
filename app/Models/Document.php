<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'tittle',
        'name',
        'uri',
        'id_supplier',
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
        return $this->belongsToMany(SupplierRequest::class, 'supplier_requests_documents', 'id_document', 'id_supplier_request');
    }
}
