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
                        <div class="row ">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Email</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="origenProveedor"
                                                id="nacionalRadio" value="nacional">
                                            Nacional
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="origenProveedor"
                                                id="extranjeroRadio" value="extranjero">
                                            Extranjero
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">NIC / RUC</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                            <div class="form-group col-md-2 pt-3 d-flex align-items-end justify-content-center">
                                <div class="d-flex flex-row">
                                    {{-- <button class="btn btn-info custom-button1">Empezar</button> --}}
                                    <a href="{{ route('r.step2') }}" class="btn btn-info custom-button1">Empezar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
