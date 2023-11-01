<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SupplierRequest;
use App\Models\StateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SupplierRequestController extends Controller
{
    public function index()
    {
        $supplierRequests = SupplierRequest::with(
            'user.supplier',
            'typePayment',
            'methodPayment',
            'documents',
            'questions'
        )->get();

        // Obtener las transiciones de estado para cada solicitud
        $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest) {
            $transitions = DB::table('transitions_state_requests')
                ->select('from_state_id', 'to_state_id', 'id_reviewer')
                ->where('id_supplier_request', $supplierRequest->id)
                ->get();

            $transitions->each(function ($transition) {
                $transition->fromState = StateRequest::find($transition->from_state_id);
                $transition->toState = StateRequest::find($transition->to_state_id);
                $transition->reviewer = User::find($transition->id_reviewer);
            });

            $supplierRequest->stateTransitions = $transitions;

            return $supplierRequest;
        });

        // dd($supplierRequests);

        return view('requests.index', compact('supplierRequestsWithTransitions'));
    }


}

