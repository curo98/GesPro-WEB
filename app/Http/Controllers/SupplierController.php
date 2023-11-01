<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::with('user')->paginate(5);

        return view('suppliers.index', compact('suppliers'));
    }
}
