<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

trait ValidateAndCreateUser
{
    protected function validator(array $data)
    {
        return Validator::make($data, User::$rules);
    }


    protected function create(array $data)
    {
        // Crear un nuevo usuario y asignarle el rol de "invitado" por defecto
        return User::createUser($data);
    }
}
