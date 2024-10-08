<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <h1>Registrar un nuevo cliente</h1>
        <form action="/CrearCliente" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="documento">Documento:</label>
                    <input type="text" name="documento" id="documento" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="number" name="telefono" id="telefono" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="activo">Estado:</label>
                    <select class="form-control" id="activo" name="estado">
                        <option value="" disabled selected>--Selecciona una opcion--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>