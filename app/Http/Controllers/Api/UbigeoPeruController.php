<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UbigeoPeruController extends Controller
{
    public function loadDepartments()
    {
        $departments = DB::select('SELECT * FROM ubigeo_peru_departments');

        return response()->json($departments);
    }


    public function loadProvinces()
    {
        $departments = DB::select('SELECT * FROM ubigeo_peru_provinces');

        return response()->json($departments);
    }

    public function loadDistricts()
    {
        $departments = DB::select('SELECT * FROM ubigeo_peru_districts');

        return response()->json($departments);
    }

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
