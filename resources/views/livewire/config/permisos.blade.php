<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestión de Permisos</strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group">
                            <input class="form-control border rounded-pill" type="search"
                                placeholder="Buscar por nombre del permiso">
                        </div>
                    </div>
                    @can('crear permisos')
                    <div class="col-md-3">
                        <div class="text-end">
                            <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Crear permiso</button>
                        </div>
                    </div>
                    @endcan
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
                            @forelse ($consulta as $permiso)
                                <tr style="cursor:pointer;" wire:click="editar({{$permiso->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($permiso->name) }}</td>
                                    <td>{{ ucfirst($permiso->guard_name) }}</td>
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
        @slot('title', $editId != null ? 'Editar Permiso' : 'Crear nuevo permiso')
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
                @can('actulizar permisos')    
                <button type="submit" class="btn btn-success">{{$editId == null ? 'Crear permiso' : 'Actualizar'}}</button>
                @endcan
            @endslot
        </form>
    @endcomponent
</div>
