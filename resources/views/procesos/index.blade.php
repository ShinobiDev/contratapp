@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-11 col-md-11">


			<table id="procesos-table" class="table table-striped table-codensed table-hover table-resposive">
		              <thead>
		                <tr>
		                  <th># Proceso</th>
		                  <th>Tipo</th>
		                  <th>Estado</th>
		                  <th>Gestión Comercial</th>
		                  <th>Entidad</th>
		                  <th>Objeto</th>
		                  <th>Dpto. y Ciudad</th>
		                  <th>Cuantía</th>
		                  <th>Fecha apertura</th>
		                  <th>Fecha cierre</th>
		                  <th>Empresa</th>
		                  <th>Usuario</th>
		                  
		                  <th>Acción</th>

		                </tr>
		              </thead>

		              <tbody>
		                
		                @forelse ($procesos as $p)
		                
		                 <tr id="row_{{$p->id}}">      
		                      <td class="text-green text-center">
		                      	<strong>{{strtoupper($p->numero_proceso)}}</strong>

		                      	<strong><a target="_blank" href="https://www.contratos.gov.co/consultas/detalleProceso.do?{{$p->link_proceso}}"><h4>Ver proceso</h4></a></strong></td>
		                      <td>{{$p->tipo_proceso}}</td>	
		                      <td><strong class="text-red">{{$p->estado_proceso}}</strong></td>	
		                      <td><strong class="text-info">{{$p->gestion_comercial}}</strong></td>	
		                      <td><strong>{{$p->entidad}}</strong></td>	
		                      <td>{{$p->objeto}}</td>	
		                      <td>{{$p->dpto_ciudad}}</td>	
		                      <td><strong class="text-green">${{$p->cuantia}}</strong></td>	
		                      <td>{{$p->fecha_apertura}}</td>	
		                      <td>{{$p->fecha_cierre}}</td>	
		                      <td>{{$p->empresa->nombre_empresa}}</td>	
		                      <td>{{$p->usuario->name}}</td>	
		                      
		                      <td>
		                        <!-- Button trigger modal -->
		                        @role('Comerciante')
		                        	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#registrarproceso{{$p->id}}">
		                          		Registrar Observación
		                        	</button>
		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                          		Cambiar fecha cierre proceso
		                        	</button>
		                        	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verobservacionesproceso{{$p->id}}">
		                          		Ver observaciones
		                        	</button>
		                        	<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cambiarestadoproceso{{$p->id}}">
		                          		Cambiar estado
		                        	</button>

		                        @else
		                        	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editarproceso{{$p->id}}">
		                          		Editar proceso
		                        	</button>
		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                          		Cambiar fecha cierre proceso
		                        	</button>
		                        	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verobservacionesproceso{{$p->id}}">
		                          		Ver observaciones
		                        	</button>
		                        	<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cambiarestadoproceso{{$p->id}}">
		                          		Cambiar estado
		                        	</button>
		                        @endrole
		                        <!-- Modal -->
		                        
		                    </td>
		                   </tr>
		                @empty
		                    <tr >      
		                      <td class="text-green text-center"><strong><h4>Aún no existen procesos registrados o asignados a este usuario</h4></strong></td>
		                      <td>
		                      <td></td>	
		                      <td></td>	
		                      <td></td>	
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

		    @foreach($procesos as $p)
		    	@role('Comerciante')
		    		<!--MODAL PARA REGISTRAR UNA OBSERVACION-->
		    		<div class="modal fade" id="registrarproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Regitro de observaciones del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('registrar_observacion',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Observación</label>
		                                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observacion" placeholder="Ingresa aquí las observaciones del proceso"></textarea>
		                                   <input type="hidden" name="id_usuario" value="{{auth()->user()->id}}">

		                                    
		                                  </div>
		                                 
		                                  <button type="submit" class="btn btn-info">Guardar Observación</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		            <!--MODAL PARA CAMBIAR FECHA CIERRE-->
		            <div class="modal fade" id="fechacierreproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Fecha de cierre del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('cambiar_fecha_cierre',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Fecha de cierre</label>
		                                   <input type="date" name="fecha_cierre" value="{{$p->fecha_cierre}}">
		                                    
		                                  </div>
		                                 
		                                  <button type="submit" class="btn btn-success">Guardar Fecha de cierre</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		            <!--MODAL PARA VER OBSERVACIONES-->
		            <div class="modal fade" id="verobservacionesproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Observaciones del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                               
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Observaciones</label>
		                                   
		                                  </div>
		                                  <div class="form-group">
		                                  	
		                                  	

		                                   <table class="table">
											  <thead>
											    <tr>
											      
											      <th scope="col">Usuario</th>
											      <th scope="col">Observación</th>
											      <th scope="col">Fecha Observación</th>
											    </tr>
											  </thead>

											  <tbody>
											  	@forelse($p->observaciones as $ob)

				                                  	@if($ob->observacion != null)
				                                   		
				                                   		 
				                                   		<tr>
													      <th scope="row">{{$ob->usuario_observaciones->name}}</th>	      
													      <td>{{$ob->observacion}}</td>
													      <td>{{$ob->created_at}}</td>
													    </tr>
				                                   		
				                                   	@endif		                                   		
			                                   	@empty
			                                   		<tr>
												      <th scope="row" colspan="3">No hay observaciones registradas para el proceso <strong>{{$p->numero_proceso}}</strong></th>	      
												      
												    </tr>
			                                   	 
			                                    @endforelse

											    
											  </tbody>
											</table>



		                                  </div>
		                                 
		                                  
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		            <!--MODAL PARA CAMBIAR ESTADOSS-->
		            <div class="modal fade" id="cambiarestadoproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="cambiarestadoprocesolabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Cambiar estado del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                               
		                                <form  method="POST" action="{{ route('cambiar_estados',$p->id) }}">
			                                  <div class="form-group">
			                                      {{ csrf_field() }}
			                                  </div>  
		                                 	 <div class="form-group">
		                                  	  
			                                   <label for="exampleFormControlTextarea1">Estado actual: <strong class="text-red">{{$p->estado_proceso}}</strong></label>
			                                   <select id="selEstado" class="form-control" name="estado_proceso">
			                                   		<option value="0">Selecciona un nuevo estado</option>
			                                   		<option value='Borrador'>Borrador</option>
			                                   		<option value="Convocado">Convocado</option>
			                                   		<option value="Adjudicado">Adjudicado</option>
			                                   		<option value="Celebrado">Celebrado</option>
			                                   		<option value="Liquidado">Liquidado</option>
			                                   		<option value="Descartado">Descartado</option>
			                                   		<option value="Terminado Anormalmente después de Convocado">Terminado Anormalmente después de Convocado</option>
			                                   		<option value="Terminado sin Liquidar">Terminado sin Liquidar</option>
			                                   		
			                                   </select>
			                                   
			                                  </div>
			                                  <div class="form-group">
				                                  	<label for="exampleFormControlTextarea1">Gestión comercial proceso: <strong class="text-green">{{$p->gestion_comercial}}</strong></label>
				                                  	<select id="selGestion" class="form-control" name="gestion_comercial">
				                                   		<option value="0">Selecciona un nuevo estado</option>
				                                   		<option value="Encontrado">Encontrado</option>
				                                   		<option value="No cumplimos">No cumplimos</option>
				                                   		<option value="Pendiente Propuesta">Pendiente Propuesta</option>
				                                   		<option value="Propuesta Presentada">Propuesta Presentada</option>
				                                   		<option value="Adjudicado">Adjudicado</option>
				                                   		<option value="No Adjudicado">No Adjudicado</option>
					                                </select>	
			                                  </div>
			                                   <button type="submit" class="btn btn-warning">Guardar cambios</button>  
		                                </form>
		                                 
		                                  
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		        @else
		        	<!--MODAL PARA EDITAR PROCESO-->
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
		                                  	  
		                                    <label for="exampleInputEmail1"> Usuario asignado</label>
		                                   </div>
		                                   <div class="form-group">
		                                   
			                                <select class="form-control"  name="nuevo_usuario" id="selUserEdi"  >
	                                             <option>selecciona un usuario</option>   
	                                         


	                                          @forelse ($users as $u)
	                                          	
	                                            @if($u->name==$p->usuario->name)
	                                              <option value="{{$p->usuario->id}}" selected>{{$u->name}}</option>
	                                            @else
	                                            
	                                              <option value="{{$u->id}}">{{$u->name}}</option>
	                                            @endif
	                                            
	                                          @empty
	                                            <option>No hay roles</option>
	                                          @endforelse
	                                        </select>
		                                    
		                                  </div>
		                                 	
		                                  <button type="submit" class="btn btn-info">Guardar cambios</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>           
		         
		            <!--MODAL PARA CAMBIAR FECHA CIERRE-->
		            <div class="modal fade" id="fechacierreproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Fecha de cierre del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('cambiar_fecha_cierre',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Fecha de cierre</label>
		                                   <input type="date" name="fecha_cierre" value="{{$p->fecha_cierre}}">
		                                    
		                                  </div>
		                                 
		                                  <button type="submit" class="btn btn-success">Guardar Fecha de cierre</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		            <div class="modal fade" id="verobservacionesproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Observaciones del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                               
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Observaciones</label>
		                                   
		                                  </div>
		                                  <div class="form-group">
		                                  	
		                                  	

		                                   <table class="table">
											  <thead>
											    <tr>
											      
											      <th scope="col">Usuario</th>
											      <th scope="col">Observación</th>
											      <th scope="col">Fecha Observación</th>
											    </tr>
											  </thead>

											  <tbody>
											  	@forelse($p->observaciones as $ob)

				                                  	@if($ob->observacion != null)
				                                   		
				                                   		 
				                                   		<tr>
													      <th scope="row">{{$ob->usuario_observaciones->name}}</th>	      
													      <td>{{$ob->observacion}}</td>
													      <td>{{$ob->created_at}}</td>
													    </tr>
				                                   		
				                                   	@endif		                                   		
			                                   	@empty
			                                   		<tr>
												      <th scope="row" colspan="3">No hay observaciones registradas para el proceso <strong>{{$p->numero_proceso}}</strong></th>	      
												      
												    </tr>
			                                   	 
			                                    @endforelse

											    
											  </tbody>
											</table>



		                                  </div>
		                                 
		                                  
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
		            <!--MODAL PARA CAMBIAR ESTADOSS-->
		            <div class="modal fade" id="cambiarestadoproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="cambiarestadoprocesolabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Cambiar estado del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                               
		                                <form  method="POST" action="{{ route('cambiar_estados',$p->id) }}">
			                                  <div class="form-group">
			                                      {{ csrf_field() }}
			                                  </div>  
		                                 	 <div class="form-group">
		                                  	  
			                                   <label for="exampleFormControlTextarea1">Estado actual: <strong class="text-red">{{$p->estado_proceso}}</strong></label>
			                                   <select id="selEstado" class="form-control" name="estado_proceso">
			                                   		<option value="0">Selecciona un nuevo estado</option>
			                                   		<option value='Borrador'>Borrador</option>
			                                   		<option value="Convocado">Convocado</option>
			                                   		<option value="Adjudicado">Adjudicado</option>
			                                   		<option value="Celebrado">Celebrado</option>
			                                   		<option value="Liquidado">Liquidado</option>
			                                   		<option value="Descartado">Descartado</option>
			                                   		<option value="Terminado Anormalmente después de Convocado">Terminado Anormalmente después de Convocado</option>
			                                   		<option value="Terminado sin Liquidar">Terminado sin Liquidar</option>
			                                   		
			                                   </select>
			                                   
			                                  </div>
			                                  <div class="form-group">
				                                  	<label for="exampleFormControlTextarea1">Gestión comercial proceso: <strong class="text-green">{{$p->gestion_comercial}}</strong></label>
				                                  	<select id="selGestion" class="form-control" name="gestion_comercial">
				                                   		<option value="0">Selecciona un nuevo estado</option>
				                                   		<option value="Encontrado">Encontrado</option>
				                                   		<option value="No cumplimos">No cumplimos</option>
				                                   		<option value="Pendiente Propuesta">Pendiente Propuesta</option>
				                                   		<option value="Propuesta Presentada">Propuesta Presentada</option>
				                                   		<option value="Adjudicado">Adjudicado</option>
				                                   		<option value="No Adjudicado">No Adjudicado</option>
					                                </select>	
			                                  </div>
			                                   <button type="submit" class="btn btn-warning">Guardar cambios</button>  
		                                </form>
		                                 
		                                  
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>               
		        @endrole
		    @endforeach
        </div>
    </div>
</div>        	
@endsection
@include('partials.scripts')
@section('scripts')

          <script>
            $(document).ready(function() {
                $('#selUserEdi').select2();
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
                filtro_url('#procesos-table');


            });
          </script>


@endsection
