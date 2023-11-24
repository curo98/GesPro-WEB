<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use App\Models\SupplierRequest;

class ChartController extends Controller
{
    public function requestByWeekend()
    {
        // Definir el orden de los días de la semana
        $dayOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        // Obtener el primer día y el último día de la semana actual
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Consulta para obtener los datos de los proveedores
        $requestsData = SupplierRequest::select(
                DB::raw('DAYNAME(created_at) as day'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderByRaw("FIELD(day, '" . implode("', '", $dayOrder) . "')")
            ->get();

        // Crear etiquetas para los días de la semana
        $labels = [];
        foreach ($requestsData as $requestDatum) {
            $labels[] = Carbon::createFromDate($requestDatum->day)->dayName;
        }

        // Obtener los datos de recuento y convertirlos en un array
        $data = $requestsData->pluck('count')->toArray();

        // Generar colores aleatorios en formato RGB para la gráfica
        $colors = [];
        foreach ($labels as $label) {
            $color = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.2)';
            $colors[] = $color;
        }

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
