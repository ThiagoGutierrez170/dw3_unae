<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Autor</title>
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

    <h1>Detalle del Autor: {{ $autor->nombre }} {{ $autor->apellido }}</h1>

    <!-- Información del autor -->
    <div class="mb-4">
        <p><strong>ID:</strong> {{ $autor->id }}</p>
        <p><strong>Nombre:</strong> {{ $autor->nombre }}</p>
        <p><strong>Apellido:</strong> {{ $autor->apellido }}</p>
        <p><strong>Documento:</strong> {{ $autor->documento }}</p>
    </div>

    <!-- Botones de acción -->
    <div>
        <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-success">
            <i class="fa fa-pencil"></i> Editar
        </a>

        <!-- Formulario para eliminar el autor -->
        <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?');">
                <i class="fa fa-trash"></i> Eliminar
            </button>
        </form>
    </div>

    <!-- Título para la lista de libros -->
    <h2 class="mt-4">Libros de {{ $autor->nombre }} {{ $autor->apellido }}</h2>

    <!-- Tabla de libros -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editorial</th>
                <th>Estado</th> <!-- Nueva columna para el estado -->
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->editorial }}</td>
                    <td>{{ $libro->estado }}</td> <!-- Muestra el estado del libro -->
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $libros->links() }}
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
