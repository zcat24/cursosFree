<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Cursos</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($consulta as $curso)
                        <div class="col-lg-4 ml-5">
                            <div class="card mt-2">
                                <div class="card-header header-cardm">
                                    <div class=" mt-2 text-center">
                                        @if ($curso->imagen != null)
                                            <img width="120px" src="{{ asset('storage/'.$curso->imagen ) }}" class="rounded-circle"
                                                alt="...">
                                        @else
                                            <img width="100px" src="{{ asset('img/elearning.png') }}"
                                                class="rounded-circle" alt="...">
                                        @endif
                                        <h6 class="card-title text-center">
                                            <strong>{{ $curso->nombre }}</strong>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body header-bodym">
                                    <p class="card-text">
                                        {{ strlen($curso->descripcion) <= 193 ? $curso->descripcion : substr($curso->descripcion, 0, 193) . '....' }}
                                    </p>
                                </div>
                                <div class="card-footer" style="position: relative;">
                                    <div class="text-center">
                                        <a class="btn btn-success" href="{{ route('registro', ['id' => $curso->id]) }}">
                                            Solicitar mas información</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                {{ $consulta->links() }}
            </div>
        </div>
    </main>
</div>
