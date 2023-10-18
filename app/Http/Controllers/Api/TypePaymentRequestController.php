<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypePayment;

class TypePaymentRequestController extends Controller
{
    public function index()
    {
        $typePayments = TypePayment::all();

        return response()->json($typePayments);
    }
}
