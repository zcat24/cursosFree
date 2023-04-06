<div class="container-fluid content">
    @php
        use Carbon\Carbon;
        $fechaCreacion = Carbon::parse($consultaEstudiante->created_at);
        $fechaActualizacion = Carbon::parse($consultaEstudiante->updated_at);
    @endphp
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestión de Estudiante</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <h5 class="card-header card-title text-center ">
                                <strong>Datos del Estudiante</strong>
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Nombres:</strong> {{ ucwords($consultaEstudiante->nombres) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Apellidos:</strong> {{ ucwords($consultaEstudiante->apellidos) }}
                                            </p>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <p><strong>Tipo de Documento:</strong>
                                                    {{ strtoupper($consultaEstudiante->tipoDocumento->prefijo) . ' - ' . ucwords($consultaEstudiante->tipoDocumento->nombre) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Numero Documento:</strong>
                                                    {{ number_format($consultaEstudiante->numero_documento, 0) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Numero de Telefono:</strong>
                                                {{ number_format($consultaEstudiante->telefono, 0) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Correo:</strong> {{ ucfirst($consultaEstudiante->email) }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Categoria:</strong>
                                                {{ ucfirst($consultaEstudiante->curso->categoria->nombre) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Curso:</strong> {{ ucfirst($consultaEstudiante->curso->nombre) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <h5 class="card-header card-title text-center">
                                <strong>Información adicional</strong>
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    <p><strong>Fecha creacion registro: </strong>
                                        {{ $fechaCreacion->day . ' - ' . ucfirst($fechaCreacion->monthName) . ' - ' . $fechaCreacion->year }}
                                    </p>
                                    <p><strong>Fecha actualización registro: </strong>
                                        {{ $fechaActualizacion->day . ' - ' . ucfirst($fechaActualizacion->monthName) . ' - ' . $fechaActualizacion->year }}
                                    </p>
                                    <p><strong>Gestor a cargo: </strong>
                                        {{ $consultaEstudiante->gestor_id == null ? 'No asignado' : ucwords($consultaEstudiante->gestor->nombres) }}
                                    </p>
                                    <hr>
                                </div>
                                <div class="row">
                                    @if($consultaEstudiante->gestor_id == null )
                                    @can('reasignar gestor')
                                    <div class="col-md-5">
                                        <button wire:click="asignarmeCurso" class="btn btn-warning">Asignarme
                                            curso</button>
                                    </div>
                                    @endcan
                                    @endif
                                    <div class="col-md-5">
                                        <select wire:model="estadoId" class="form-select"
                                            aria-label="Default select example"
                                            {{ $consultaEstudiante->gestor_id == auth()->user()->id ? '' : 'disabled' }}>
                                            <option selected value="{{$consultaEstudiante->estado_id}}">{{ucfirst($consultaEstudiante->estado->nombre)}}</option>
                                            @foreach ($consultaEstados as $estado)
                                                <option value="{{ $estado->id }}">
                                                    {{ ucfirst($estado->nombre) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button {{ $consultaEstudiante->gestor_id == auth()->user()->id ? '' : 'disabled' }} wire:click="cambioEstado" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
