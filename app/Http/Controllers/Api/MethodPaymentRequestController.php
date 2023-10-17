<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MethodPaymentRequestController extends Controller
{
    public function index()
    {
        $methodPayments = App\Models\MethodPayment::all();

        return response()->json($methodPayments);
    }
}
