<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestión de Roles</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group">
                            <input class="form-control border rounded-pill" type="search"
                                placeholder="Buscar por nombre del rol">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-end">
                            <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Crear Rol</button>
                        </div>
                    </div>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Seguridad</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($consulta as $rol)
                                <tr style="cursor:pointer;" wire:click="editar({{ $rol->id }})"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($rol->name) }}</td>
                                    <td>{{ ucfirst($rol->guard_name) }}</td>
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
    @component('components.modal')
        @slot('title', $editId != null ? 'Editar Rol' : 'Crear nuevo Rol')
        @slot('body')
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" wire:model="nombre">
                    @error('nombre')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endslot
            @slot('footer')
                <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal"
                    wire:click="limpiar">Cerrar</button>
                <button type="submit" class="btn btn-success">{{ $editId == null ? 'Crear Rol' : 'Actualizar' }}</button>
                @if ($editId)
                    <div class="text-end">
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#administrarRol">Administrar Rol <i
                                class="fa-solid fa-people-roof fa-xl"></i></button>
                    </div>
                @endif
            @endslot
        </form>
    @endcomponent

    <div wire:ignore.self class="modal fade" id="administrarRol" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="rolLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar Permisos al rol {{$nombre}}</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('asignarPermiso'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('asignarPermiso') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('eliminarPermiso'))
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('eliminarPermiso') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @forelse ($consultaPermisos as $permiso)
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        wire:click="asignarPermiso({{ $permiso->id }})"
                                        {{ $this->validarPermiso($editId, $permiso->id) }}>
                                    <label class="form-check-label"
                                        for="flexSwitchCheckDefault">{{ ucfirst($permiso->name) }}</label>
                                </div>
                            </div>
                        @empty
                            <p>No hay permisos registrados</p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrarRoles"
                        data-bs-dismiss="modal" wire:click="limpiar">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
