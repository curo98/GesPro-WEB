<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MethodPayment;

class MethodPaymentRequestController extends Controller
{
    public function index()
    {
        $methodPayments = MethodPayment::all();

        return response()->json($methodPayments);
    }
}
