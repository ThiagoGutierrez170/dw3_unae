<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
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

    <h1>Lista de Libros</h1>

    <!-- Botón para abrir el modal de creación -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Nuevo Libro</button>
    <br><br>

    <!-- Tabla de libros -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editorial</th>
                <th>Estado</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->editorial }}</td>
                    <td>{{ $libro->estado }}</td>
                    <td>{{ $libro->autor->nombre }} {{ $libro->autor->apellido }}</td>
                    <td>
                        
                        <!-- Botón para abrir el modal de edición -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-{{ $libro->id }}">
                            <i class="fa fa-pencil"></i> Editar
                        </button>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal-{{ $libro->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $libro->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $libro->id }}">Editar Libro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('libros.actualizar', $libro->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="titulo">Título:</label>
                                            <input type="text" class="form-control" name="titulo" value="{{ $libro->titulo }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editorial">Editorial:</label>
                                            <input type="text" class="form-control" name="editorial" value="{{ $libro->editorial }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_autores">Autor:</label>
                                            <select name="id_autores" class="form-control" required>
                                                @foreach ($autores as $autor)
                                                    <option value="{{ $autor->id }}" {{ $libro->id_autores == $autor->id ? 'selected' : '' }}>
                                                        {{ $autor->nombre }} {{ $autor->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar Libro</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para eliminar -->
                        <form action="{{ route('libros.eliminar', $libro->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?');">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $libros->links() }}
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Nuevo Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('libros.crear') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="editorial">Editorial:</label>
                    <input type="text" class="form-control" name="editorial" required>
                </div>
                <div class="form-group">
                    <label for="id_autores">Autor:</label>
                    <select name="id_autores" class="form-control" required>
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Crear Libro</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
