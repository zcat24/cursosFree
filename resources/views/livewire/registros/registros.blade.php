<div class="container-fluid content">
    <div class="d-flex justify-content-center">
        <div class="card col-md-9 mt-3">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Registrarse</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-2">Tipo de documento:</label>
                        <select wire:model="tipoDocumentoId" class="form-select" aria-label="Default select example">
                            <option selected>Seleccione un tipo documento</option>
                            @foreach ($consultaTipoDocto as $tipo)
                                <option value="{{ $tipo->id }}">{{ ucfirst($tipo->nombre) }}</option>
                            @endforeach
                        </select>
                        @error('tipoDocumentoId')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-2">N° de documento:</label>
                        <input type="number" class="form-control" wire:model="numeroDocto">
                        @error('numeroDocto')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label mt-2">Nombres:</label>
                        <input type="text" class="form-control" wire:model="nombres">
                        @error('nombres')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label mt-2">Apellidos:</label>
                        <input type="text" class="form-control" wire:model="apellidos">
                        @error('apellidos')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-2">Telefono:</label>
                        <input type="number" class="form-control" wire:model="telefono">
                        @error('telefono')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-2">Correo:</label>
                        <input type="text" class="form-control" wire:model="correo">
                        @error('correo')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label mt-2">Curso:</label>
                        <select wire:model="cursoId" class="form-select" aria-label="Default select example">
                            <option selected value="">Seleccione un curso</option>
                            @foreach ($consultaCursos as $curso)
                                <option value="{{ $curso->id }}">{{ ucfirst($curso->nombre) }}</option>
                            @endforeach
                        </select>
                        @error('cursoId')
                            <div class="message error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-1 mt-3">
                            <button type="button" wire:click="saveRegister"
                                class="btn btn-primary">Registrarme</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
