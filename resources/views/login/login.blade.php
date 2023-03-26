<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>coursesFree</title>
    {{-- <link rel="icon" href="{{ asset('img/olimpo64x64.png') }}" type="image/x-icon"> --}}
    @vite(['resources/sass/app.scss','resources/js/app.js', 'resources/css/login.css'])
</head>

<body class="text-center">
    <main class="container">
        <img class="mb-5 img-fluid" src="{{ asset('img/curso.png') }}" alt="olimpo" width="22%"
            height="auto">

        <div class="form-signin">
            <form method="POST">
                @csrf
                <div class="form-floating">
                    <input class="form-control" value="{{ old('usuario') }}" name="usuario" type="text"
                        placeholder="usuario" autofocus require>
                    <label for="floatingInput">Usuario</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" name="password" type="password" placeholder="Password" require>
                    <label for="floatingPassword">Contraseña</label>
                    @error('usuario')
                        <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                    @enderror
                    @error('password')
                        <div class="alert alert-danger" role="alert"> {{ $message }}</div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar <i
                        class="fa-solid fa-arrow-right-to-bracket"></i></button>
                <p class="mt-5 mb-3 text-muted">&copy; Desarrollado por IT {{ date('Y') }}</p>
            </form>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/5ce6cb56f5.js" crossorigin="anonymous"></script>
</body>

</html>
