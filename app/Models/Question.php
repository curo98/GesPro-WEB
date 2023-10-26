<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // public function supplierRequests()
    // {
    //     return $this->belongsToMany(SupplierRequest::class, 'supplier_requests_questions');
    // }

    public function supplierRequests()
    {
        return $this->belongsToMany(SupplierRequest::class, 'supplier_requests_questions', 'id_question', 'id_supplier_request');
    }
}
