<div class="container-fluid">
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
                        <select wire:model="" class="form-select" aria-label="Default select example">
                            <option selected value="">Seleccione un tipo documento</option>
                            @foreach ($consultaTipoDocto as $tipo)
                                <option value="{{ $tipo->id }}">{{ ucfirst($tipo->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-2">N° de documento:</label>
                        <input type="number" class="form-control" wire:model="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label mt-2">Nombres:</label>
                        <input type="text" class="form-control" wire:model="">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label mt-2">Apellidos:</label>
                        <input type="text" class="form-control" wire:model="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-2">Telefono:</label>
                        <input type="number" class="form-control" wire:model="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-2">Correo:</label>
                        <input type="text" class="form-control" wire:model="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label mt-2">Curso:</label>
                        <select wire:model="" class="form-select" aria-label="Default select example">
                            @foreach ($consultaCursos as $curso)
                            <option selected value="{{$cursoId}}">{{ ucfirst($curso->nombre) }}</option>
                                <option value="{{ $curso->id }}">{{ ucfirst($curso->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-1 mt-3">
                            <button type="button" class="btn btn-primary">Registrarme</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
