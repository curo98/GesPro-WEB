<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'id_user',
        'content'
    ];

    public function requests() {
        return $this->belongsToMany(SupplierRequest::class,  'supplier_requests_observations',  'id_supplier_request', 'id_observation');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
