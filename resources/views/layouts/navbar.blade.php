<nav class="navbar navbar-light bg-light fixed-top navbar-curso"
    >
    <div class="container-fluid">
        @if (auth()->check())
            @include('layouts.navbar-auth')
        @else
            @include('layouts.navbar-guest')
        @endif
    </div>
</nav>
