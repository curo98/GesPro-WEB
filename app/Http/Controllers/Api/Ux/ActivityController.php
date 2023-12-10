<?php

namespace App\Http\Controllers\Api\Ux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\ux\Activity;
use \App\Models\ux\Destination;
use \App\Models\ux\Bus;
use \App\Models\ux\Fare;
use \App\Models\ux\TouristSpot;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $a = Destination::all();

        return $a;
    }

    public function getBuses($id) {
    // Obtener todas las tarifas que coincidan con el ID de destino
    $fares = Fare::where('destination_id', $id)->get();

    // Obtener los IDs únicos de las compañías de autobuses
    $busCompanyIds = $fares->pluck('bus_id')->unique();

    // Obtener la información de las compañías de autobuses
    $busCompanies = Bus::whereIn('id', $busCompanyIds)->get();

    // Crear un array para almacenar la información completa de las compañías de autobuses
    $busCompaniesInfo = [];

    // Iterar sobre cada compañía de autobuses
    foreach ($busCompanies as $busCompany) {
        // Obtener las tarifas específicas para esta compañía y destino
        $companyFares = $fares->where('bus_id', $busCompany->id);

        // Crear un array para almacenar la información de la compañía y sus tarifas
        $companyInfo = [
            'id' => $busCompany->id,
            'name' => $busCompany->name,
            'uri' => $busCompany->uri,
            'fares' => [],
        ];

        // Iterar sobre las tarifas y agregar la información al array
        foreach ($companyFares as $fare) {
            $companyInfo['fares'][] = [
                'destination_id' => $fare->destination_id,
                'price' => $fare->price,
                // Otros campos relevantes de la tarifa
            ];
        }

        // Agregar la información de la compañía al array principal
        $busCompaniesInfo[] = $companyInfo;
    }

    // Retornar la información completa de las compañías de autobuses
    return response()->json($busCompaniesInfo);
}



    public function getTourist(){

        $a = TouristSpot::all();

        return $a;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
