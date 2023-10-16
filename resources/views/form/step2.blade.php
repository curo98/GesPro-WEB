
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

                    <div class="row pt-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Email 1</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Email 2</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Calle / Numero</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Urbanizacion / AA.HH / Otro</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Pais</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Departamento</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Cuidad / Distrito</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Condicion de pago</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Vias de pago</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-start">
                            <div class="d-flex flex-row">
                                <button class="btn btn-info custom-button2">Anterior</button>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
                            <div class="d-flex flex-row">
                                <button class="btn btn-info custom-button2">Siguiente</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection