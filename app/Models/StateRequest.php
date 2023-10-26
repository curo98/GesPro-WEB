<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'description',
        'created_at',
        'updated_at',
    ];

    public function supplierRequests()
    {
        return $this->belongsTo(SupplierRequest::class, 'id');
    }

    public function statesRequests()
    {
        return $this->belongsToMany(SupplierRequest::class, 'transitions_state_requests', 'from_state_id', 'to_state_id', 'id_supplier_request');
    }

}
