<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(){

        return 'Hola llegue hasta aqui';

        // return response()->json(auth()->user());
    }

}
