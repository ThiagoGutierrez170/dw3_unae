<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Lista de Tarjetas</title>
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h1>Lista de Tarjetas</h1>
        <a href="{{ url('formulario') }}" class="btn btn-primary">Nuevo</a>
        <br><br>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarjetas as $tar)
                <tr>
                    <td>{{ $tar->id }}</td>
                    <td>{{ $tar->nombre }}</td>
                    <td>{{ $tar->descripcion }}</td>
                    <td>{{ $tar->created_at }}</td>
                    <td>{{ $tar->updated_at }}</td>

                    <td>
                        <!-- Botón para abrir el modal de edición -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-{{ $tar->id }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal-{{ $tar->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $tar->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $tar->id }}">Editar Tarjeta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('actualizarTarjeta', $tar->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tar->nombre }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripcion:</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $tar->descripcion }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para borrar -->
                        <form action="{{ url('eliminarTarjeta', $tar->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarjeta?');">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $tarjetas->links() }}
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
