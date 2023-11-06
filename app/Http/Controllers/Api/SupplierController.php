<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Supplier;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('user')->get();

        return response()->json($suppliers);
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
        // Crea un nuevo usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('1234556'),
            'id_role' => 2
            // Agrega otros campos de usuario si es necesario
        ]);

        // Crea un nuevo proveedor y asócialo con el usuario
        $proveedor = Proveedor::create([
            'nic_ruc' => $request->input('nic_ruc'),
            'nacionality' => $request->input('nacionality'),
            'id_user' => $user->id,// Asocia el proveedor con el usuario recién creado
            'state' => 'inactivo'
        ]);
        return $proveedor;

        // Puedes realizar otras acciones aquí, como enviar una respuesta JSON con el proveedor creado
        return response()->json($proveedor, 201); // 201 significa "Created" (creado)

    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $supplier = Supplier::findOrFail($id);

    //     return $supplier;
    // }

    public function show($id)
    {
        $supplier = Supplier::with('user')->find($id);

        if ($supplier) {
            return response()->json($supplier);
        } else {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::with('user')->find($id);

        if ($supplier) {
            return response()->json($supplier);
        } else {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtén los datos del request
        $name = $request->input('name');
        $nic_ruc = $request->input('nic_ruc');

        // Ejecuta una consulta SQL para actualizar los campos en la base de datos
        DB::table('suppliers')
            ->where('id', $id)
            ->update([
                'nic_ruc' => $nic_ruc
            ]);

        // A continuación, actualiza el nombre del usuario asociado al proveedor
        DB::table('users')
            ->join('suppliers', 'users.id', '=', 'suppliers.id_user')
            ->where('suppliers.id', $id)
            ->update(['users.name' => $name]);

        return response()->json(['message' => 'Proveedor actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
