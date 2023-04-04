<div class="container-fluid content">
    <main>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="card-title text-center mt-3">
                    <strong>Gestión de Categorias</strong>
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
                    @can('crear categorias')
                        <div class="col-md-3">
                            <div class="text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Crear Categoria</button>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Prefijo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($consulta as $categoria)
                                <tr style="cursor:pointer;" wire:click="edit({{ $categoria->id }})"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($categoria->prefijo) }}</td>
                                    <td>{{ ucfirst($categoria->nombre) }}</td>
                                    @if ($categoria->activo == 1)
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
    @component('components.modal')
        @slot('title', $editId != null ? 'Editar Categoria' : 'Crear Nueva Categoria')

        @slot('body')

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <form wire:submit.prevent="save">

                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label"> <strong>Prefijo:</strong> </label>
                    <div class="col-sm-8">
                        <input wire:model="prefijo" type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label"> <strong>Nombre:</strong> </label>
                    <div class="col-sm-8">
                        <input wire:model="nombre" type="text" class="form-control">
                    </div>
                </div>

                @if ($editId)
                    @can('eliminar categorias')
                    <div class="form-check form-switch mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Activo:</label>
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="activo">
                    </div>
                    @endcan
                @endif

            @endslot
            @slot('footer')
                <div class="text-end">
                    <button  id="cerrarCategoria" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            @endslot
        </form>

    @endcomponent
</div>
