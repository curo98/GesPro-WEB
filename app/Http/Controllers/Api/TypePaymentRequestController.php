<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypePaymentRequestController extends Controller
{
    public function index()
    {
        $typePayments = App\Models\TypePayment::all();

        return response()->json($typePayments);
    }
}
