@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">


			<table id="procesos-table" class="table table-striped table-codensed table-hover table-resposive">
		              <thead>
		                <tr>
		                  <th># Proceso</th>
		                  <th>Tipo</th>
		                  <th>Estado</th>
		                  <th>Entidad</th>
		                  <th>Objeto</th>
		                  <th>Dpto. y Ciudad</th>
		                  <th>Cuantía</th>
		                  <th>Fecha apertura</th>
		                  <th>Empresa</th>
		                  <th>Usuario</th>
		                  <th>Gestión Comercial</th>
		                  <th>Acción</th>

		                </tr>
		              </thead>

		              <tbody>
		                
		                @forelse ($procesos as $p)
		                
		                 <tr id="row_{{$p->id}}">      
		                      <td class="text-green text-center"><strong><a target="_blank" href="https://www.contratos.gov.co/consultas/detalleProceso.do?{{$p->link_proceso}}"><h4>{{strtoupper($p->numero_proceso)}}</h4></a></strong></td>
		                      <td>{{$p->tipo_proceso}}</td>	
		                      <td>{{$p->estado_proceso}}</td>	
		                      <td>{{$p->entidad}}</td>	
		                      <td>{{$p->objeto}}</td>	
		                      <td>{{$p->dpto_ciudad}}</td>	
		                      <td>${{$p->cuantia}}</td>	
		                      <td>{{$p->fecha_apertura}}</td>	
		                      <td>{{$p->empresa->nombre_empresa}}</td>	
		                      @if($p->usuario!=null)
		                      	<td>{{$p->usuario->usuario_asignado->name}}</td>	
		                      @else
		                      	<td>{{$p->usuario}}</td>	
		                      @endif

		                      <td>{{$p->gestion_comercial}}</td>	
		                      <td>
		                        <!-- Button trigger modal -->
		                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarproceso{{$p->id}}">
		                          Editar proceso
		                        </button>

		                        <!-- Modal -->
		                        <div class="modal fade" id="editarproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="editarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Editar proceso</h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                 <form  method="POST" action="{{ route('editar_proceso',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                    
		                                    <label for="exampleInputEmail1">Nombre *****</label>
		                                    <input type="text" name="nombre_empresa" class="form-control"   placeholder="Ingresa el nuevo nombre de la empresa" value="{{$p->id}}">
		                                    
		                                  </div>
		                                  
		                                   <button type="submit" class="btn btn-primary">Guardar cambios</button>   
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		                        </div>
		                    </td>
		                   </tr>
		                @empty
		                    <tr >      
		                      <td class="text-green text-center"><strong><h4>Aún no existen procesos registrados</h4></strong></td>
		                      <td>
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
		                      
		                        
		                    </td>
		                   </tr>
		                @endforelse

		                
		                
		              </tbody>
		              
		    </table>
        </div>
    </div>
</div>        	
@endsection
@section('scripts')

          <script>
            $(document).ready(function() {
                console.log("5");
                $('#procesos-table').DataTable( {
                    responsive: true,
                    stateSave: true,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    language:
                      {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                } );
                filtro_url('#compras-table');


            });
          </script>


@endsection
