<div class="container-fluid">
    <main id="main" class="main">
        <section class="section">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card  mt-3">
                        <div class="card-body ">
                            <h4 class="card-title text-center"><Strong>Consultas</Strong></h4>
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-1 mt-2 text-end" style="width: 9%">
                                    <label><strong>Tipo de consulta:</strong></label>
                                </div>
                                <div class="col-12 col-md-12 col-lg-1" style="width: 16%">
                                    <select wire:model="tipoconsulta" class="form-select text-center">
                                        <option selected>Seleccione tipo consulta</option>
                                        <option value="1">Categorias</option>
                                        <option value="2">Cursos</option>
                                        <option value="3">Registros Usuarios</option>
                                        <option value="4">Gestores de cursos</option>
                                    </select>
                                </div>
                                {{-- @if ($tipoconsulta == 1 || $tipoconsulta == 4 || $tipoconsulta == 2)
                                    <div class="col-12 col-md-12 col-lg-1 mt-2 text-end" style="width: 3%">
                                        <label><strong>Sede:</strong></label>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-1" style="width: 12%">
                                        <select wire:model="sedeId" class="form-select text-center">
                                            <option selected>Seleccione sede</option>
                                            @foreach ($consultaSede as $sede)
                                                <option value="{{ $sede->id }}">{{ ucfirst($sede->nombre) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif --}}
                                {{-- @if ($tipoconsulta == 2)
                                    <div class="col-12 col-md-12 col-lg-1 mt-2 text-end" style="width: 5%">
                                        <label><strong>Producto:</strong></label>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-1" style="width: 16%">
                                        <input wire:model="producto" class="form-control text-center" type="text">
                                        @if ($consultaProductos && $activaBuscar == true)
                                            @forelse($consultaProductos as $producto)
                                                <ul>
                                                    <li class="m-2">
                                                        <a style="cursor:pointer;" class="dropdown-item text-center"
                                                            wire:click="capturarProducto({{ $producto }})">
                                                            {{ ucfirst($producto->nombre) }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            @empty
                                                <ul>
                                                    <li class="m-2">
                                                        <a class="dropdown-item" style="cursor:pointer;">
                                                            No se encontraron productos
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endforelse
                                        @endif
                                    </div>
                                @endif --}}
                                <div class="col-12 col-md-12 col-lg-1 mt-2 text-center" style="width: 4%">
                                    <label><strong>Desde:</strong></label>
                                </div>
                                <div class="col-12 col-md-12 col-lg-1" style="width: 10%">
                                    <input wire:model="fechaDesde" class="form-control text-center" type="date">
                                </div>
                                <div class="col-12 col-md-12 col-lg-1 mt-2 text-center" style="width: 4%">
                                    <label><strong>Hasta:</strong></label>
                                </div>
                                <div class="col-12 col-md-12 col-lg-1" style="width: 10%">
                                    <input wire:model="fechaHasta" class="form-control text-center" type="date">
                                </div>
                                @if ($tipoconsulta != null)
                                    <div class="col-12 col-md-12 col-lg-1">
                                        <button type="button" class="btn btn-success" wire:click="exportarConsulta"
                                            {{ empty($consulta) ? 'disabled' : (count($consulta) > 0 ? '' : 'disabled') }}><i
                                                class="fa-solid fa-file-arrow-down"></i> Exportar</button>
                                    </div>
                                @endif
                            </div>
                            @if (!empty($consulta))
                                <div class="row">
                                    @if ($tipoconsulta == 1)
                                        <h4 class="card-title text-center mt-3"><Strong>Consulta de Categorias</Strong></h4>
                                        <div class="mt-3 table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Prefijo</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Fecha Creacion</th>
                                                        <th scope="col">fecha Actualizacion</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @forelse($consulta as $registro)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ strtoupper($registro->prefijo) }}</td>
                                                            <td>{{ ucfirst($registro->nombre) }}</td>
                                                            <td>{{ $registro->created_at }}</td>
                                                            <td>{{ $registro->updated_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <td colspan="5">No hay categorias</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @elseif($tipoconsulta == 2)
                                        <h4 class="card-title text-center mt-3"><Strong>Consulta Cursos</Strong></h4>
                                        <div class="mt-3 table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Categoria</th>
                                                        <th scope="col">Nombre Curso</th>
                                                        <th scope="col">Descripcion</th>
                                                        <th scope="col">Creador</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Fecha Creacion</th>
                                                        <th scope="col">fecha Actualizacion</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @forelse($consulta as $registro)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ ucfirst($registro->categoria->nombre) }}</td>
                                                            <td>{{ ucfirst($registro->nombre) }}</td>
                                                            <td>{{ ucfirst($registro->descripcion) }}</td>
                                                            <td>{{ $registro->creador_id == null ? 'Cursos Administrativo' : ucfirst($registro->creador->nombres) }}</td>
                                                            <td>{{ $registro->activo == 1 ? 'Activo' : 'No Activo' }}</td>
                                                            <td>{{ $registro->created_at }}</td>
                                                            <td>{{ $registro->updated_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <td colspan="8">No hay Cursos</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @elseif($tipoconsulta == 3)
                                        <h4 class="card-title text-center mt-3"><Strong>Consulta de Registros de Usuarios</Strong></h4>
                                        <div class="mt-3 table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tipo - N°  Documento</th>
                                                        <th scope="col">Nombres Completos</th>
                                                        <th scope="col">Telefono</th>
                                                        <th scope="col">Correo</th>
                                                        <th scope="col">Curso</th>
                                                        <th scope="col">Gestor</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Fecha Creacion</th>
                                                        <th scope="col">fecha Actualizacion</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @forelse($consulta as $registro)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $registro->tipoDocumento->prefijo.' - '.$registro->numero_documento }}</td>
                                                            <td>{{ ucwords($registro->nombres).' '.ucwords($registro->apellidos) }}</td>
                                                            <td>{{ number_format($registro->telefono, 0) }}</td>
                                                            <td>{{ ucfirst($registro->email) }}</td>
                                                            <td>{{ ucfirst($registro->curso->nombre) }}</td>
                                                            <td>{{ $registro->gestor_id == null ? 'No asignado' : ucfirst($registro->gestor->nombres) }}</td>
                                                            <td>{{ $registro->estado->nombre}}</td>
                                                            <td>{{ $registro->created_at }}</td>
                                                            <td>{{ $registro->updated_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <td colspan="10">No hay Registros</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <h4 class="card-title text-center mt-3"><Strong>Consulta de Gestores</Strong></h4>
                                        <div class="mt-3 table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Cedula</th>
                                                        <th scope="col">Correo</th>
                                                        <th scope="col">Categoria Asignada</th>
                                                        <th scope="col">Fecha Creacion</th>
                                                        <th scope="col">fecha Actualizacion</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @forelse($consulta as $registro)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ ucwords($registro->gestores->nombres) }}</td>
                                                            <td>{{ number_format($registro->gestores->cedula, 0) }}</td>
                                                            <td>{{ ucfirst($registro->gestores->email) }}</td>
                                                            <td>{{ ucfirst($registro->categoriaAsignada->nombre) }}</td>
                                                            <td>{{ $registro->created_at }}</td>
                                                            <td>{{ $registro->updated_at }}</td>
                                                        </tr>
                                                    @empty
                                                        <td colspan="7">No hay Gestores</td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
