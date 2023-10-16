
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
                                    <ul>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Consectetur adipiscing elit</li>
                                        <li>Integer molestie lorem at massa</li>
                                        <li>Facilisis in pretium nisl aliquet</li>
                                        <li>Nulla volutpat aliquam velit
                                    </ul>
                                </div>
                                  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <h5>Documentos necesarios</h5>
                            <button class="btn btn-info">Modelo de carta descargado</button>
                        </div>
                        <div class="form-group pt-3 col-md-6">
                            <h5>Opciones de documentos</h5>
                            <div class="form-group col-md-5" style="color: green">
                                <h6><i class="fas fa-paperclip"></i> Adjuntar documento</h6>
                                <h6><i class="far fa-eye"></i> Visualizar / Editar documento adjunto</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Codigo de etica y conducta</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile"><i class="fas fa-paperclip"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Constitucion de la empresa</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile"><i class="fas fa-paperclip"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">DNI del representante legal</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile"><i class="fas fa-paperclip"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Carta firmada y membretada con datos bancarios </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile"><i class="fas fa-paperclip"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Ficha RUC </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile">
                                    <label class="custom-file-label" for="inputFile"><i class="fas fa-paperclip"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 pt-3 d-flex justify-content-center align-items-center">
                            <div class="form-check align-items-end">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Acepto cumplir con el codigo de etica
                                </label>
                            </div>
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