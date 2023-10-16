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
                        <div class="form-group col-md-12">
                            <h5>Instrucciones</h5>
                            <div class="row">
                                <div>
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos deserunt voluptatibus, esse reprehenderit animi minima autem blanditiis pariatur nihil ullam at neque quibusdam reiciendis minus officiis ducimus, sit accusamus. Beatae?</p>
                                </div>
                                  
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-10 col-8">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor architecto ipsam id, dolorem laboriosam suscipit laudantium, ex beatae eos rem repellendus facilis et odit dignissimos optio ab vel mollitia ducimus.</p>
                        </div>
                        <div class="form-group col-md-2 col-4 d-flex justify-content-end">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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