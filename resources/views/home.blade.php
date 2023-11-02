@extends('layouts.app')

@section('content')
    @if (auth()->user()->role->name === 'admin')
        <div class="container-fluid pt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card w-80 mx-auto">

                        <div class="card-body">
                            @if (session('notification'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('notification') }}
                                </div>
                            @endif
                            <h6>Notificacion general</h6>
                            <h4 class="card-title">Notificar a todos los usuarios</h4>
                            <br>
                            <form action="{{ url('/fcm/send') }}" method="post">
                                @csrf
                                <div class="row ">
                                    <div class="form-group">
                                        <label for="title">Titulo</label>
                                        <input value="{{ config('app.name') }}" type="text" class="form-control"
                                            name="title" id="title" required>
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <div class="form-group">
                                        <label for="body">Mensaje</label>
                                        <textarea name="body" class="form-control" id="body" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="form-group">
                                        <div class="d-flex flex-row">
                                            <button class="btn btn-info custom-button1">Enviar notificacion</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container min-vh-100 d-flex flex-column justify-content-center">
        <div class="row my-3">
            <div class="col">
                <h4>Bootstrap 4 Chart.js - Bar Chart</h4>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="chBar" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>




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
                                    <button class="btn btn-info custom-button1">Empezar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-start">
                                <div class="d-flex flex-row">
                                    <button class="btn btn-info custom-button2">Anterior</button>
                                </div>
                            </div>
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
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
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
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
                                        <label class="custom-file-label" for="inputFile"><i
                                                class="fas fa-paperclip"></i></label>
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
                                        <label class="custom-file-label" for="inputFile"><i
                                                class="fas fa-paperclip"></i></label>
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
                                        <label class="custom-file-label" for="inputFile"><i
                                                class="fas fa-paperclip"></i></label>
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
                                        <label class="custom-file-label" for="inputFile"><i
                                                class="fas fa-paperclip"></i></label>
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
                                        <label class="custom-file-label" for="inputFile"><i
                                                class="fas fa-paperclip"></i></label>
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
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-start">
                                <div class="d-flex flex-row">
                                    <button class="btn btn-info custom-button2">Anterior</button>
                                </div>
                            </div>
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
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
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos deserunt
                                            voluptatibus, esse reprehenderit animi minima autem blanditiis pariatur nihil
                                            ullam at neque quibusdam reiciendis minus officiis ducimus, sit accusamus.
                                            Beatae?</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-10 col-8">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor architecto ipsam id,
                                    dolorem laboriosam suscipit laudantium, ex beatae eos rem repellendus facilis et odit
                                    dignissimos optio ab vel mollitia ducimus.</p>
                            </div>
                            <div class="form-group col-md-2 col-4 d-flex justify-content-end">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                        value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                        value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-start">
                                <div class="d-flex flex-row">
                                    <button class="btn btn-info custom-button2">Anterior</button>
                                </div>
                            </div>
                            <div
                                class="col-md-6 pt-3 d-flex align-items-end justify-content-center justify-content-md-end">
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
