@extends('layouts.app')

@section('content')
    @if (auth()->user()->role->name === 'admin' || auth()->user()->role->name === 'contabilidad')
        <div class="container-fluid pt-5">
            <div class="row justify-content-center">
                @if (auth()->user()->role->name === 'admin')
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
                                    <div class="row">
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
                @endif
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Gráfico de Barras de Solicitudes de Proveedores</h4>
                            <canvas id="barChart" height="170"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container min-vh-100 d-flex flex-column justify-content-center">
        <div class="row my-3">
            <div class="col">
                <h4>Gráfico de Barras de Solicitudes de Proveedores</h4>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="barChart" height="00"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById("barChart").getContext('2d');
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;
        var colors = <?php echo json_encode($colors); ?>;

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Solicitudes por día',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                var dayOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado',
                                    'Domingo'
                                ];
                                return dayOrder[index];
                            }
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
