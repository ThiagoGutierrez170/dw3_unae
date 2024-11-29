<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Lista de materias</title>
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h1>Lista de materias</h1>
        <a href="{{ url('formulario') }}" class="btn btn-primary">Nueva materia</a>
        <br><br>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Materia</th>
                    <th>Acta</th>
                    <th>Estado</th>
                    <th>Semestre</th>
                    <th>Curso</th>
                    <th>Año</th>
                    <th>Docente</th>
                    <th>Horas</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materias as $materia)
                <tr>
                    <td>{{ $materia->id }}</td>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->nro_materia }}</td>
                    <td>{{ $materia->acta }}</td>
                    <td>{{ $materia->estado }}</td>
                    <td>{{ $materia->semestre }}</td>
                    <td>{{ $materia->curso }}</td>
                    <td>{{ $materia->anho }}</td>
                    <td>{{ $materia->docente }}</td>
                    <td>{{ $materia->horas }}</td>
                    <td>{{ $materia->created_at }}</td>
                    <td>{{ $materia->updated_at }}</td>
                    <td>
                        <!-- Botón para abrir el modal de edición -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-{{ $materia->id }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal-{{ $materia->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $materia->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $materia->id }}">Editar materia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('actualizarMateria', $materia->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group mb-3">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $materia->nombre }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nro_materia">Número de Materia:</label>
                                                <input type="number" class="form-control" id="nro_materia" name="nro_materia" value="{{ $materia->nro_materia }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="acta">Acta:</label>
                                                <input type="text" class="form-control" id="acta" name="acta" value="{{ $materia->acta }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="estado">Estado:</label>
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="activo" {{ $materia->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                                    <option value="inactivo" {{ $materia->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="semestre">Semestre:</label>
                                                <input type="text" class="form-control" id="semestre" name="semestre" value="{{ $materia->semestre }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="curso">Curso:</label>
                                                <input type="text" class="form-control" id="curso" name="curso" value="{{ $materia->curso }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="anho">Año:</label>
                                                <input type="date" class="form-control" id="anho" name="anho" value="{{ $materia->anho }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="docente">Docente:</label>
                                                <input type="text" class="form-control" id="docente" name="docente" value="{{ $materia->docente }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="horas">Horas:</label>
                                                <input type="text" class="form-control" id="horas" name="horas" value="{{ $materia->horas }}">
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
                        <form action="{{ url('eliminarMateria', $materia->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta materia?');">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $materias->links() }}
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
