<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_state',
        'id_type_payment',
        'id_method_payment',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function state()
    {
        return $this->belongsTo(StateRequest::class, 'id_state');
    }

    public function typePayment()
    {
        return $this->belongsTo(TypePayment::class, 'id_type_payment');
    }

    public function methodPayment()
    {
        return $this->belongsTo(MethodPayment::class, 'id_method_payment');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'supplier_requests_documents', 'id_supplier_request', 'id_documents');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'supplier_requests_questions', 'id_supplier_request', 'id_question');
    }
}
