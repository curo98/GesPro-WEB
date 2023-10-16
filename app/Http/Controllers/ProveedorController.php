<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function formStep1()
    {
        return view('form.step1');
    }

    public function formStep2()
    {
        return view('form.step2');
    }

    public function formStep3()
    {
        return view('form.step3');
    }

    public function formStep4()
    {
        return view('form.step4');
    }

    public function formStep5()
    {
        return view('form.step5');
    }
}
