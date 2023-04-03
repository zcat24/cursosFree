<div class="container-fluid content">
    <main>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-2 m-2">
                        <div class="card-body p-2">
                            <div class="class text-center">
                                <h4 class="card-title"><Strong>Gestion de cursos</Strong></h4>
                            </div>
                            <div class="row">
                                @livewire('datatables.registro-table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <button id="btn-modal" data-bs-toggle="modal" data-bs-target="#miModal" hidden></button>


    <div wire:ignore class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog-centered modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gestores</h5>
                </div>
                <div class="modal-body">
                        <select wire:model="gestrorId" class="form-select" aria-label="Default select example">
                            <option selected value="">Seleccione un Gestor</option>
                            @foreach ($gestores as $gestor)
                                <option value="{{ $gestor->id }}">{{ ucfirst($gestor->nombres) }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrarGestor"
                        data-bs-dismiss="modal" wire:click="limpiar">Cerrar</button>
                    <button  class="btn btn-primary" wire:click="asignarGestor()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>
