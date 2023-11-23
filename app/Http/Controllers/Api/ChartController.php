<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
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
