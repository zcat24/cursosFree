<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestion de usuarios</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group">
                            <input class="form-control border rounded-pill" type="search"
                                placeholder="Buscar por cedula o nombre">
                        </div>
                    </div>
                    <div class="col-md-3">
                        @can('crear usuario')
                            <div class="text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Crear usuario</button>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Correo</th>
                                @can('asignar categorias')
                                    <th scope="col">Asignar categoria</th>
                                @endcan
                                @can('asignar roles a usuarios')
                                    <th scope="col">Asignar perfil</th>
                                @endcan
                                <th scope="col">Restablecer clave</th>
                                <th scope="col">Estado</th>
                                @can('editar usuarios')
                                    <th scope="col" width="10%">Opciones</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($consulta as $usuario)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($usuario->username) }}</td>
                                    <td>{{ ucwords($usuario->nombres) }}</td>
                                    <td>{{ $usuario->cedula }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    @can('asignar categorias')
                                        <td><button class="btn btn-success"
                                                wire:click="editarCategoria({{ $usuario->id }})" data-bs-toggle="modal"
                                                data-bs-target="#asignarCategoria"><i
                                                    class="fa-solid fa-sheet-plastic fa-lg"></i></button></td>
                                    @endcan
                                    @can('asignar roles a usuarios')
                                        <td><button class="btn btn-primary" wire:click="editarRol({{ $usuario->id }})"
                                                data-bs-toggle="modal" data-bs-target="#asignarRol"><i
                                                    class="fa-solid fa-id-card-clip fa-lg"></i></button>
                                        </td>
                                    @endcan
                                    <td><button wire:click="restablecerPassword({{ $usuario->id }})"
                                            class="btn btn-warning"><i
                                                class="fa-sharp fa-solid fa-arrows-rotate fa-lg"></i></button></td>
                                    @if ($usuario->activo == 1)
                                        <td><i class="fa-sharp fa-solid fa-circle-check fa-lg"
                                                style="color: green;"></i>
                                        </td>
                                    @else
                                        <td><i class="fa-solid fa-circle-xmark fa-lg" style="color: red;"></i>
                                        </td>
                                    @endif
                                    @can('editar usuarios')
                                        <td><button wire:click="edit({{ $usuario->id }})" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop" class="btn btn-info"><i
                                                    class="fa-solid fa-user-pen fa-lg"></i></button>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
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
    {{-- editar y crear usuario --}}
    @component('components.modal')
        @slot('title', $editId != null ? 'Editar Usuario' : 'Crear nuevo usuario')
        @slot('body')
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Username:</label>
                    <input type="text" class="form-control" wire:model="username">
                    @error('username')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" wire:model="nombres">
                    @error('nombres')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Cedula:</label>
                    <input type="number" class="form-control" wire:model="cedula">
                    @error('cedula')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Fecha Nacimiento:</label>
                    <input type="date" class="form-control" wire:model="fechaNacimiento">
                    @error('fechaNacimiento')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Correo:</label>
                    <input type="text" class="form-control" wire:model="email">
                    @error('email')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($editId)
                    @can('desativar usuario')
                        <div class="form-check form-switch mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Activo:</label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="activo">
                        </div>
                    @endcan
                @endif
            @endslot
            @slot('footer')
                <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal"
                    wire:click="limpiar">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            @endslot
        @endcomponent
    </form>
    {{-- categorias --}}
    <div wire:ignore.self class="modal fade" id="asignarCategoria" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="perfilLabel" aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar Categorias</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('asignarCategoria'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('asignarCategoria') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('eliminarCategoria'))
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('eliminarCategoria') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @forelse ($consultaCategoria as $categoria)
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        wire:click="asignarCategoria({{ $categoria->id }})"
                                        {{ $this->validarCategoria($editId, $categoria->id) }}>
                                    <label class="form-check-label"
                                        for="flexSwitchCheckDefault">{{ ucfirst($categoria->nombre) }}</label>
                                </div>
                            </div>
                        @empty
                            <p>No hay categorias registrados</p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrarsede" data-bs-dismiss="modal"
                        wire:click="limpiar">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- asignar rol --}}
    <div wire:ignore.self class="modal fade" id="asignarRol" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="perfilLabel" aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar Rol a {{ $nombres }}</h5>
                </div>
                <div class="modal-body">
                    <select wire:model="asignarRolId" class="form-select" aria-label="Default select example">
                        <option selected value="">Seleccione un Rol</option>
                        @foreach ($consultaRol as $rol)
                            <option value="{{ $rol->id }}">{{ ucfirst($rol->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrarRol" data-bs-dismiss="modal"
                        wire:click="limpiar">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:click="asignarRol()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
