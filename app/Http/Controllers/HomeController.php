<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SupplierRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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

        // Pasar los datos a la vista
        return view('home', compact('labels', 'data', 'colors'));
    }


}
