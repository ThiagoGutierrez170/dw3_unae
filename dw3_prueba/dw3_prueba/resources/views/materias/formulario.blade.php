<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Añadir Nueva Materia</title>
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="{{ url('inicio') }}" class="btn btn-primary">Volver</a>
        <h1>Añadir Nueva Materia</h1>
        <form action="/crearMateria" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="nro_materia" class="form-label">Número Materia</label>
                <input type="number" name="nro_materia" id="nro_materia" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="acta" class="form-label">Acta</label>
                <input type="text" name="acta" id="acta" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="semestre" class="form-label">Semestre</label>
                <input type="text" name="semestre" id="semestre" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" name="curso" id="curso" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="anho" class="form-label">Año</label>
                <input type="date" name="anho" id="anho" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="docente" class="form-label">Docente</label>
                <input type="text" name="docente" id="docente" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="horas" class="form-label">Horas</label>
                <input type="text" name="horas" id="horas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Guardar
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
