@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card w-80 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Título de la Tarjeta</h5>
                            <div class="bd-example">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre del solicitante</th>
                                            <th scope="col">Nacionalidad</th>
                                            <th scope="col">Estado actual</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplierRequestsWithTransitions as $sr)
                                            <tr>
                                                <th scope="row">{{ $sr->id }}</th>
                                                <td>{{ $sr->user->name }}</td>
                                                @if ($sr->user->supplier)
                                                    <td>{{ $sr->user->supplier->nacionality }}</td>
                                                @else
                                                    <td>Proveedor no asignado</td>
                                                @endif
                                                <td>{{ $sr->getFinalState()->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" title="Visualizar">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-success" title="Validar">
                                                        <i class="fas fa-check"></i>
                                                    </button>

                                                    <div class="dropdown" style="display: inline-block;">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Acciones
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if (auth()->user()->role->name == 'compras' || auth()->user()->role->name == 'contabilidad')
                                                                <form action="{{ url('/requests/check', $sr->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <li><button class="dropdown-item" type="submit">
                                                                            Validar</button></li>
                                                                </form>
                                                            @endif
                                                            <li><button class="dropdown-item" type="button">
                                                                    Aprobar</button></li>
                                                            <li><button class="dropdown-item" type="button">
                                                                    Rechazar</button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
