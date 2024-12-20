<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://kit.fontawesome.com/03ca14290a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
</head>

<body class="bg-secondary">
    <div class="row g-0 vh-100">
        <!-- Columna izquierda (Imagen y mensaje) -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center text-center" 
            style="background-image: url('{{ asset('assets/img/pngwing.com.png') }}'); 
                   background-size: cover; 
                   background-position: center; 
                   background-repeat: no-repeat;">

            <div class="overlay"
                style="position: absolute; 
                       top: 0; 
                       left: 0; 
                       width: 100%; 
                       height: 100%; 
                       background-color: rgba(0, 0, 0, 0.5);">
            </div>

            <div class="working-animation position-relative text-white">
                <h2 class="mt-3 fw-bold">Estamos trabajando</h2>
                <h2 class="mt-3 fw-bold">para responder tu petición</h2>
                <div class="spinner-grow text-danger mt-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Columna derecha (Formulario de búsqueda) -->
        <div class="col-12 col-md-6 d-flex align-items-center">
            <div class="container">
                <!-- Mostrar errores -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario -->
                <form class="bg-gradient-primary p-4 rounded-lg" action="{{ route('consulta.show') }}" method="POST">
                    <div class="d-flex justify-content-center align-items-center text-center mb-4">
                        <div class="sidebar-brand-icon me-2">
                            <img class="img-fluid" src="{{ asset('assets/img/pixelcut-export.png') }}" 
                                 alt="Logo" style="max-width: 50px; height: auto;">
                        </div>
                        <h1 class="text-white fw-bold">Consulta de Peticiones</h1>
                    </div>
                    @csrf
                    <div class="mb-3">
                        <label for="id" class="form-label text-white">Número de la Petición</label>
                        <input type="text" name="id" id="id" class="form-control" 
                            placeholder="Introduce el número de tu petición" value="{{ old('id') }}" required>
                    </div>
                    <script>
                        @if (session('error'))
                            Swal.fire({
                                title: "Error",
                                text: "Esta peticion no existe",
                                imageUrl: "https://media.tenor.com/zzZZwwmB-6YAAAAM/warning.gif",
                                imageAlt: "Custom image"
                            });
                        @elseif (session('success'))
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: '{{ session('success') }}'
                            });
                        @endif
                    </script>
                    <button type="submit" class="btn btn-success mt-3"><i class="fa-solid fa-magnifying-glass">
                            Buscar</i></button>
                    <a href="{{ route('pqr.registrar') }}" class="btn btn-danger mt-3"><i class="fa-solid fa-arrow-left">
                            Volver</i></a>
                </form>

                <!-- Mostrar resultados si existen -->
                @if (isset($peticiones))
                    <div class="bg-gradient-primary shadow p-4 rounded-lg mt-4">
                        <h3 class="text-primary">Resultado:</h3>
                        <div class="mb-3">
                            <label for="nombreCompleto" class="form-label text-white">Nombre Completo</label>
                            <input type="text" id="nombreCompleto" class="form-control"
                                value="{{ $peticiones->nombreCompleto }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tipoPeticion" class="form-label text-white">Tipo de Petición</label>
                            <input type="text" id="tipoPeticion" class="form-control"
                                value="{{ $peticiones->tipoPeticion }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label text-white">Descripción</label>
                            <input type="text" id="descripcion" class="form-control"
                                value="{{ $peticiones->descripcion }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="respuesta" class="form-label text-white">Respuesta</label>
                            <input type="text" id="respuesta" class="form-control" 
                                value="{{ $peticiones->respuesta ?? 'En proceso' }}" readonly>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/show.js') }}"></script>
    @livewireScripts
</body>

</html>
