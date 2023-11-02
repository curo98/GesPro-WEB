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
    $dayOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    $startDate = Carbon::now()->startOfWeek(); // Obtener el primer día de la semana actual
    $endDate = Carbon::now()->endOfWeek(); // Obtener el último día de la semana actual

    $requestsData = SupplierRequest::select(
            DB::raw('DAYNAME(created_at) as day'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('day')
        ->orderByRaw("FIELD(day, '" . implode("', '", $dayOrder) . "')")
        ->get();

    $labels = [];
    foreach ($requestsData as $requestDatum) {
        $labels[] = Carbon::createFromDate($requestDatum->day)->dayName;
    }
    $data = $requestsData->pluck('count')->toArray();

    $colors = [];
    foreach ($labels as $label) {
        // Generar un color aleatorio en formato RGB
        $color = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.2)';
        $colors[] = $color;
    }

    return view('home', compact('labels', 'data', 'colors'));
}


}
