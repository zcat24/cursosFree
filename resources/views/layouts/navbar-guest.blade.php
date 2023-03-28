<button class="navbar-toggler" type="button">
    <img width="30px" src="{{ asset('img/curso.png') }}" alt="">
</button>
<div class="text-start">
    <a class="ms-3 navbar-brand font-monospace " href="{{ route('welcome') }}"> <img style="margin-left: 10%"
            class="fluid" src="{{ asset('img/curso.png') }}" alt="O" width="40px" />CoursesFree</a>
</div>
<a class="nav-link nav-profile d-flex align-items-center p-0" href="{{ route('login') }}">
    <img width="28px" height="auto" src="{{ asset('img/iniciar-sesion.png') }}" alt="Profile"
        class="rounded-circle">Iniciar session
</a>