<div class="dropdown" style="display: inline-block;">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Acciones
    </button>
    <ul class="dropdown-menu">
        <form action="{{ route('requests.receive', ['id' => $sr->id]) }}" method="post">
            @csrf
            <button type="submit" class="dropdown-item">Recibir <i class="fas fa-check"></i></button>
        </form>

        <form action="{{ route('requests.check', ['id' => $sr->id]) }}" method="post">
            @csrf
            <button type="submit" class="dropdown-item">Validar <i class="fas fa-check"></i></button>
        </form>
        <li><button class="dropdown-item" type="button">Rechazar <i class="fas fa-times"></i></button></li>

    </ul>
</div>
