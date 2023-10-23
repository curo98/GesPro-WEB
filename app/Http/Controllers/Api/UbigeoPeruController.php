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


    public function getProvincesByDepartment($department) {
        $provinces = DB::select("SELECT * FROM ubigeo_peru_provinces WHERE department_id = :department", ['department' => $department]);

        return response()->json($provinces);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getDistricts($province)
    {
        $districts = DB::select("SELECT * FROM ubigeo_peru_districts WHERE province_id = :province", ['province' => $province]);

        return response()->json($districts);
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
