@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card w-80 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Proveedores</h5>
                            <div class="bd-example">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Nacionalidad</th>
                                            <th scope="col">RUC / NIC</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $s)
                                            <tr>
                                                <th scope="row">{{ $s->id }}</th>
                                                <td>{{ $s->user->name }}</td>
                                                @if ($s->nacionality)
                                                    <td>{{ $s->nacionality }}</td>
                                                @else
                                                    <td>Proveedor no asignado</td>
                                                @endif
                                                <td>{{ $s->nic_ruc }}</td>
                                                @if ($s->state === 'inactivo')
                                                    <td><span class="badge bg-secondary">{{ $s->state }}</span></td>
                                                @else
                                                    <td><span class="badge bg-success">{{ $s->state }}</span></td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-success" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if (auth()->user()->role->name === 'admin')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Enlaces de paginación con Bootstrap -->
                                <div class="pagination-container">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $suppliers->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <!-- Enlaces de páginas -->
                                            <li
                                                class="page-item {{ $suppliers->currentPage() == $suppliers->lastPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $suppliers->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
