<div class="container-fluid content">
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-2 m-2">
                        <div class="card-body p-2">
                            <div class="class text-center">
                                <h4 class="card-title"><Strong>Gestion de Estados</Strong></h4>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Buscar nombre del estado o prefijo" aria-label="search"
                                            aria-describedby="search-addon">
                                        <span class="input-group-text" id="search-addon"><i
                                                class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <button type="button" class="mx-2 btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Crear Nuevo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Icono</th>
                                            <th scope="col">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @forelse ($consulta as $registro)
                                            <tr style="cursor:pointer;" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop" wire:click="edit({{ $registro->id }})">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ ucfirst($registro->nombre) }}</td>
                                                @if ($registro->icono)
                                                    <td>{!! $registro->icono !!}</td>
                                                @else
                                                    <td>No asignado</td>
                                                @endif
                                                @if ($registro->activo == 1)
                                                    <td><i class="fa-solid fa-circle-check fa-xl"
                                                            style="color: green;"></i>
                                                    </td>
                                                @else
                                                    <td><i class="fa-solid fa-circle-xmark fa-xl" style="color: red;">
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <td colspan="4">Sin registros</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="">
                                {{ $consulta->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @component('components.modal')
        @slot('title', $editId != null ? 'Editar Estado' : 'Crear Nuevo Estado')

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
                    <label for="name" class="col-sm-4 col-form-label"> <strong>Nombre:</strong> </label>
                    <div class="col-sm-8">
                        <input wire:model="nombre" type="text" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label"> <strong>Icono:</strong> </label>
                    <div class="col-sm-8">
                        <textarea wire:model="icono" class="form-control" id="exampleFormControlTextarea1" rows="3">Ingrese el icono de fontawesome</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label"> <strong>Color:</strong> </label>
                    <div class="col-sm-8">
                        <input wire:model="color" type="color" class="form-control form-control-color" id="exampleColorInput"
                            value="#563d7c" title="Choose your color">
                    </div>
                </div>

                @if ($editId)
                    <div class="form-check form-switch mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Activo:</label>
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="activo">
                    </div>
                @endif

            @endslot
            @slot('footer')
                <div class="text-end">
                    <button wire:click="resetIput" id="cerrarEstado" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            @endslot
        </form>

    @endcomponent
</div>
