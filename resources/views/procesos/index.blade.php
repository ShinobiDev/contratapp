@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12">


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
		                      <td ><label class="text-info">{{$f = ($p->fecha_cierre != null) ? $p->fecha_cierre : 'Sin asignar'}}</label></td>	
		                      <td><strong>{{$p->empresa->nombre_empresa}}</strong></td>	
		                      <td>{{$p->usuario->name}}</td>	
		                      
		                      <td>
		                        <!-- Button trigger modal -->
		                        @role('Comerciante')
		                        	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#registrarproceso{{$p->id}}">
		                          		Registrar Observación
		                        	</button>

		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                          		{{$variable = $p->fecha_cierre != '' ? 'Cambiar fecha cierre proceso' : 'Asignar fecha cierre proceso'}}
		                        	</button>
		                        	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verobservacionesproceso{{$p->id}}">
		                          		Ver observaciones 
		                        	</button>
		                        	<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cambiarestadoproceso{{$p->id}}">
		                          		Cambiar estado
		                        	</button>

		                        @else
		                        	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editarproceso{{$p->id}}">
		                          		Cambiar usuario
		                        	</button>
		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                          		{{$variable = $p->fecha_cierre != '' ? 'Cambiar fecha cierre proceso' : 'Asignar fecha cierre proceso'}}
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
		    		
		            <!--MODAL PARA CAMBIAR USUARIO PROCESO-->
						@include('partials.editarproceso')
					<!--/ MODAL PARA CAMBIAR USUARIO PROCESO-->       				
		         	<!--MODAL PARA CAMBIAR FECHA CIERRE-->
		            	@include('partials.fechacierreproceso')
		            <!--/MODAL PARA CAMBIAR FECHA CIERRE-->
		            <!--MODAL PARA VER OBSERVACIONES DE PROCESOS-->
		            	@include('partials.verobservacionesproceso')
		            <!--MODAL PARA VER OBSERVACIONES DE PROCESOS-->
		            <!--MODAL PARA CAMBIAR ESTADOSS-->
		            	@include('partials.cambiarestadoproceso')
					<!--/MODAL PARA CAMBIAR ESTADOSS-->
					<!--MODAL PARA REGISTRAR UNA OBSERVACION-->
						@include('partials.registrarproceso')
					<!--/MODAL PARA REGISTRAR UNA OBSERVACION-->
					
		        @else
		        	
					<!--MODAL PARA CAMBIAR USUARIO PROCESO-->
						@include('partials.editarproceso')
					<!--/ MODAL PARA CAMBIAR USUARIO PROCESO-->       				
		         	<!--MODAL PARA CAMBIAR FECHA CIERRE-->
		            	@include('partials.fechacierreproceso')
		            <!--/MODAL PARA CAMBIAR FECHA CIERRE-->
		            <!--MODAL PARA VER OBSERVACIONES DE PROCESOS-->
		            	@include('partials.verobservacionesproceso')
		            <!--MODAL PARA VER OBSERVACIONES DE PROCESOS-->
		            <!--MODAL PARA CAMBIAR ESTADOSS-->
		            	@include('partials.cambiarestadoproceso')
					<!--/MODAL PARA CAMBIAR ESTADOSS-->			                           
		        @endrole
		    @endforeach
        </div>
    </div>
</div>        	
@endsection

@section('scripts')

          <script>
            $(document).ready(function() {
                $('#selUserEdi').select2();

                var table=$('#procesos-table').DataTable( {
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
                if(sessionStorage.getItem("este")!="" && sessionStorage.este != undefined){
                	table.$('tr.selected').removeClass('selected');
                    $("#"+sessionStorage.getItem("este")).addClass('selected');
                }
                $('#procesos-table tbody').on( 'click', 'tr', function () {
			        if ( $(this).hasClass('selected') ) {
			            //$(this).removeClass('selected');
			        }
			        else {
			            table.$('tr.selected').removeClass('selected');
			            $(this).addClass('selected');
			            
			            if(this.id!=""){
			            	console.log(this.id);
			            	sessionStorage.setItem("este", this.id);

			            }else{
			            	console.log("vacio");
			            	console.log(this.id);
			            }
			        }
			    } );
                //filtro_url('#procesos-table');


            });


          </script>


@endsection
@include('partials.scripts')