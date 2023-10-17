<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\StateRequest;

class StateRequestController extends Controller
{
    public function index(){

        $stateRequests = StateRequest::all();

        return response()->json($stateRequests);
    }
}
