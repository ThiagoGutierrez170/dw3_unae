<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
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

    <h1>Lista de Autores</h1>

    <!-- Botón para abrir el modal de creación -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Nuevo Autor</button>
    <br><br>

    <!-- Tabla de autores -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nombre }}</td>
                    <td>{{ $autor->apellido }}</td>
                    <td>{{ $autor->documento }}</td>
                    <td>
                        <!-- Botón para ver el detalle -->
                        <a href="{{ route('autor.show', $autor->id) }}" class="btn btn-info">
                            <i class="fa fa-eye"></i> Detalle
                        </a>

                        <!-- Botón para abrir el modal de edición -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-{{ $autor->id }}">
                            <i class="fa fa-pencil"></i> Editar
                        </button>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal-{{ $autor->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $autor->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $autor->id }}">Editar Autor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('autores.update', $autor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" value="{{ $autor->nombre }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido:</label>
                                            <input type="text" class="form-control" name="apellido" value="{{ $autor->apellido }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="documento">Documento:</label>
                                            <input type="text" class="form-control" name="documento" value="{{ $autor->documento }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar Autor</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para eliminar -->
                        <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?');">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $autores->links() }}
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Nuevo Autor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('autores.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="documento">Documento:</label>
                    <input type="text" class="form-control" name="documento" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Autor</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
