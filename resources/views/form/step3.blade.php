@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card w-80 mx-auto">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <label for="inputEmail4">Politica de proveedores</label>
                            </div>
                            <div class="col-md-8 d-flex justify-content-center align-items-center">
                                <object data="{{ asset('manual.pdf') }}" type="application/pdf" width="100%"
                                    height="500px">
                                    <p>Tu navegador no puede mostrar el PDF. Puedes <a
                                            href="{{ asset('manual.pdf') }}">descargarlo aquí</a>.</p>
                                </object>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10 pt-3 d-flex justify-content-center align-items-center">
                                <div class="form-check align-items-end">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Acepto la política de proveedores 1
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-10 d-flex justify-content-center align-items-center">
                                <div class="form-check align-items-end">
                                    <input class="form-check-input" type="checkbox" id="gridCheck2">
                                    <label class="form-check-label" for="gridCheck2">
                                        Acepto la política de proteccion de datos
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-start">
                                <div class="d-flex flex-row">
                                    <button class="btn btn-info custom-button2">Anterior</button>
                                </div>
                            </div>
                            <div class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
                                <div class="d-flex flex-row">
                                    {{-- <button class="btn btn-info custom-button2">Siguiente</button> --}}
                                    <a href="{{ route('r.step4') }}" class="btn btn-info custom-button2">Siguiente</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
