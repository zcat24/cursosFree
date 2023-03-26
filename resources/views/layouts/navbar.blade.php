<nav class="navbar navbar-light bg-light fixed-top"
    style="  position: relative; box-shadow: 0px 8px 45px rgba(0, 0, 0, 0.2);">
    <div class="container-fluid">
        @if (auth()->check())
            @include('layouts.navbar-auth')
        @else
            @include('layouts.navbar-guest')
        @endif
    </div>
</nav>
