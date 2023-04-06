<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestión de Cursos</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group">
                            <input class="form-control border rounded-pill" type="search"
                                placeholder="Buscar por nombre del curso">
                        </div>
                    </div>
                    @can('crear cursos')
                        <div class="col-md-3">
                            <div class="text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Crear Curso</button>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Nombre Curso</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Creador del Curso</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($consulta as $curso)
                                <tr style="cursor:pointer;" wire:click="editar({{ $curso->id }})"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($curso->categoria->nombre) }}</td>
                                    <td>{{ ucfirst($curso->nombre) }}</td>
                                    <td style="width: 570px;">{{ ucfirst($curso->descripcion) }}</td>
                                    <td>{{ $curso->imagen != null ? 'Si' : 'No' }}</td>
                                    <td>{{ $curso->creador_id != null ? ucfirst($curso->creador->nombres) : 'Administrativo' }}
                                    </td>

                                    @if ($curso->activo == 1)
                                        <td><i class="fa-solid fa-circle-check fa-xl" style="color: green;"></i>
                                        </td>
                                    @else
                                        <td><i class="fa-solid fa-circle-xmark fa-xl" style="color: red;">
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <td colspan="6">Sin registros</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $consulta->links() }}
                </div>
            </div>
        </div>
    </main>

    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editId != null ? 'Editar Curso' : 'Crear Nuevo Curso' }}</h5>
                    @if ($editId)
                        @can('eliminar cursos')
                            <div class="form-check form-switch ">
                                <label for="formGroupExampleInput2" class="form-label">Activo:</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    wire:model="activo">
                            </div>
                        @endcan
                    @endif
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form wire:submit.prevent="save">

                        <div class="mb-3 row">
                            <div class="col-md-2">
                                <label for="name" class="col-sm-4 col-form-label"> <strong>Categoria:</strong>
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <select wire:model="categoria" class="form-select" aria-label="Default select example">
                                    <option selected value="">Seleccione una categoria</option>
                                    @foreach ($consultaCategoria as $categoria)
                                        <option value="{{ $categoria->id }}">{{ ucfirst($categoria->nombre) }}</option>
                                    @endforeach
                                </select>
                                {{-- <input wire:model="categoria" type="text" class="form-control"> --}}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-2">
                                <label for="name" class="col-sm-4 col-form-label"> <strong>Nombre Curso:</strong>
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <input wire:model="nombreCurso" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row ">
                            <div class="col-md-2">
                                <label for="exampleTextarea"><strong>Descripcion:</strong></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea wire:model="descripcion" class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row ">
                            <div class="col-md-2">
                                <label for="exampleTextarea"><strong>Imagen del Curso:</strong></label>
                            </div>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input wire:model="imagen" type="file" class="form-control" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Imagen</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <button wire:click="limpiar" id="cerrarcurso" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                            @can('modificar cursos')
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
