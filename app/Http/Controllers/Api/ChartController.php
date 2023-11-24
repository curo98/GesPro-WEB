<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use App\Models\SupplierRequest;

class ChartController extends Controller
{
    public function counts()
    {
        $countUsers = User::count();
        $countRequests = SupplierRequest::count();

        return response()->json([
            'countUsers' => $countUsers,
            'countRequests' => $countRequests,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function getUsersByRole()
    {
        $rolesWithCounts = User::select('roles.name as role', \DB::raw('count(*) as count'))
            ->join('roles', 'users.id_role', '=', 'roles.id')
            ->groupBy('roles.name')
            ->get();

        return response()->json($rolesWithCounts);
    }

}
