@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5">
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
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        title="Visualizar">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    @if (auth()->user()->role->name === 'proveedor')
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif

                                                    <div class="dropdown" style="display: inline-block;">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Acciones
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if (auth()->user()->role->name === 'compras')
                                                                @if ($sr->getFinalState()->name === 'Por recibir')
                                                                    <form
                                                                        action="{{ route('requests.receive', ['id' => $sr->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">Recibir
                                                                            <i class="fas fa-check"></i></button>
                                                                    </form>
                                                                @endif

                                                                @if ($sr->getFinalState()->name === 'Por validar')
                                                                    <form
                                                                        action="{{ route('requests.check', ['id' => $sr->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">Validar
                                                                            <i class="fas fa-check"></i></button>
                                                                    </form>
                                                                @endif
                                                            @endif

                                                            @if ($sr->getFinalState()->name === 'Por aprobar')
                                                                <li><button class="dropdown-item" type="button">
                                                                        Aprobar <i class="fas fa-check"></i></button></li>
                                                            @endif

                                                            <li><button class="dropdown-item" type="button">
                                                                    Rechazar <i class="fas fa-times"></i></button></li>

                                                            <li><button class="dropdown-item" type="button">
                                                                    Cancelar <i class="fas fa-times"></i></button></li>
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
