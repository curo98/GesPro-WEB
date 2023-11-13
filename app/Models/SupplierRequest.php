<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
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

    public function stateTransitions()
    {
        return $this->belongsToMany(StateRequest::class, 'transitions_state_requests', 'id_supplier_request', 'from_state_id', 'to_state_id');
    }

    public function getFinalState()
    {
        // Verificar si hay al menos una transición de estado
        if ($this->stateTransitions->isNotEmpty()) {
            // Obtener la última transición de estado
            $lastTransition = $this->stateTransitions->last();
            // Verificar si existe un "to_state"
            if ($lastTransition->toState) {
                return $lastTransition->toState;
            }
            // Si no hay "to_state", mostrar "from_state"
            return $lastTransition->fromState;
        }
        return null; // No hay transiciones de estado
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
        return $this->belongsToMany(Question::class, 'supplier_requests_questions', 'id_supplier_request', 'id_question')
            ->withPivot('response');
    }

    public function policies() {
        return $this->belongsToMany(Policy::class, 'supplier_requests_policies', 'id_supplier_request', 'id_policie')
            ->withPivot('accepted');
    }

    public function observations() {
        return $this->belongsToMany(Observation::class, 'supplier_requests_observations', 'id_supplier_request', 'id_observation');
    }

    public function reviewers() {
        return $this->belongsToMany(User::class, 'transitions_state_requests', 'id_supplier_request', 'id_user');
    }



}
