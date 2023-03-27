<div class="container-fluid">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Cursos</strong>
                </h4>
            </div>
            <div class="card-body">
                @foreach ($consulta as $curso)
                    <div class="col-lg-2 ml-5">
                        <div class="card mt-2">
                            <div class=" mt-2 text-center">
                                @if ($curso->imagen != null)
                                    <img width="120px" src="{{ asset('img/mesa.png') }}" class="rounded-circle"
                                        alt="...">
                                @else
                                    <img width="100px" src="{{ asset('img/elearning.png') }}" class="rounded-circle"
                                        alt="...">
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="card-title text-center">
                                    <strong>{{ $curso->nombre }}</strong>
                                </h6>
                                <p class="card-text">{{ $curso->descripcion }}</p>
                                <div class="text-center">
                                    <a class="btn btn-success" href="{{ route('registro', ['id' => $curso->id]) }}">
                                        Solicitar mas información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                {{ $consulta->links() }}
            </div>
        </div>
    </main>
</div>
