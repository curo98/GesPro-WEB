<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use App\Models\SupplierRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function requestByWeekend()
    {
        $requestsData = SupplierRequest::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $labels = [];
    $data = [];

    foreach ($requestsData as $requestDatum) {
        $labels[] = Carbon::create()->month($requestDatum->month)->format('F'); // Obtén el nombre del mes
        $data[] = $requestDatum->count;
    }

    $colors = [];

    // Puedes generar colores aleatorios o definir un conjunto específico de colores según tus preferencias.

    return response()->json([
        'labels' => $labels,
        'data' => $data,
        'colors' => $colors,
    ]);
    }
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
