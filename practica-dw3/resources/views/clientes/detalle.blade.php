<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Cliente</title>
    <!-- Enlaces de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Préstamos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clientes.lista') }}"><i class="fa fa-users"></i> Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('libros.lista') }}"><i class="fa fa-book"></i> Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('autores.lista') }}"><i class="fa fa-pencil-alt"></i> Autores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Detalle del Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }}</h1>

    <!-- Información del cliente -->
    <div class="mb-4">
        <p><strong>ID:</strong> {{ $cliente->id }}</p>
        <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
        <p><strong>Apellido:</strong> {{ $cliente->apellido }}</p>
        <p><strong>Documento:</strong> {{ $cliente->documento }}</p>
    </div>

    <!-- Botones de acción -->
    <div>
        <!-- Botón para abrir modal de creación de préstamo -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearPrestamoModal">
            <i class="fa fa-plus"></i> Crear Préstamo
        </button>
    </div>

    <!-- Modal para crear un préstamo -->
    <div class="modal fade" id="crearPrestamoModal" tabindex="-1" aria-labelledby="crearPrestamoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('prestamos.crear') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="crearPrestamoModalLabel">Crear Préstamo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_libro" class="form-label">Libro</label>
                        @if($libros->isEmpty())
                            <p class="text-danger">No hay libros disponibles para préstamo.</p>
                        @else
                            <select name="id_libro" required>
                                @foreach ($libros as $libro)
                                    <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-select" required>
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="devuelto">Devuelto</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Título para la lista de préstamos -->
    <h2 class="mt-4">Préstamos de {{ $cliente->nombre }} {{ $cliente->apellido }}</h2>

    <!-- Tabla de préstamos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libro</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->id }}</td>
                    <td>{{ $prestamo->libro->titulo }}</td>
                    <td>
                    <form action="{{ route('prestamos.actualizar', $prestamo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($prestamo->estado === 'pendiente')
                            <form action="{{ route('prestamos.actualizar', $prestamo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="estado" required>
                                    <option value="devuelto">Devuelto</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </form>
                        @else
                            <p>{{ ucfirst($prestamo->estado) }}</p>
                        @endif
                    </form>
                    </td>
                    <td>
                        <form action="{{ route('prestamos.eliminar', $prestamo->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?');">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $prestamos->links() }}
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
