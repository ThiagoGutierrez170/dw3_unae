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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->editorial }}</td>
                    <td>
                        <!-- Ver detalle del libro -->
                        <a href="{{ route('libro.vista', $libro->id) }}" class="btn btn-info">
                            <i class="fa fa-eye"></i> Detalle
                        </a>
                    </td>
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
