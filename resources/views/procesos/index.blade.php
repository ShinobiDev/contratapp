@extends('layouts.app')

@section('header')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">


@endsection

@section('content')
<div class="responsive">
	<div  class="box box-success ">
		<div class="box-header ">
        <a href="{{route('registrar_procesos')}}" class="btn btn-primary pull-right"><strong><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear procesos</strong></a>  
       	<i>Si deseas ver más información debes dar clic sobre la tabla y desplazarte de izquierda a derecha con las fechas del teclado </strong></i>  
      </div>
		<div class="box-body panel-horizontal " >
			<table id="procesos-table" class="table table-striped table-codensed table-hover responsive" style="overflow-x: auto;">
		              <thead>
		                <tr class="bg-blue">
		                  <th># Proceso</th>
		                  <th>Tipo</th>
		                  <th>Estado</th>
		                  <th>Gestión Comercial</th>
		                  <th>Entidad</th>
		                  <th>Objeto</th>
		                  <th>Dpto. y Ciudad</th>
		                  <th>Cuantía</th>
		                  <th>Fecha de registro</th>
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
		                      <td class="text-green text-center bg-danger" >
		                      	<strong>{{strtoupper($p->numero_proceso)}}</strong>

		                      	<strong><a target="_blank" href="https://www.contratos.gov.co/consultas/detalleProceso.do?{{$p->link_proceso}}"><h4>Ver proceso  <i class="fa fa-rocket"></i></h4></a></strong></td>
		                      <td class="text-purple"><strong class="text-purple">{{$p->tipo_proceso}}</strong></td>	
		                      <td ><strong class="text-red">{{$p->estado_proceso}}</strong></td>	
		                      <td><strong class="text-info">{{$p->gestion_comercial}}</strong></td>	
		                      <td ><strong>{{$p->entidad}}</strong></td>	
		                      <td ><p>{{$p->objeto}}</p></td>	
		                      <td class="text-red"><b>{{$p->dpto_ciudad}}</b></td>	
		                      <td><strong class="text-green">${{$p->cuantia}}</strong></td>	
		                      <td class="text-info">{{$p->created_at}}</td>	
		                      <td >{{$p->fecha_apertura}}</td>	
		                      <td ><label class="text-info">{{$f = ($p->fecha_cierre != null) ? $p->fecha_cierre : 'Sin asignar'}}</label></td>	
		                      <td ><strong class="text-red">{{$p->empresa->nombre_empresa}}</strong></td>	
		                      <td>{{$p->usuario->name}}</td>	
		                      
		                      <td >
		                        <!-- Button trigger modal -->
		                        @role('Comerciante')
		                        	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#registrarproceso{{$p->id}}">
		                          		<b><i class="fa fa-pencil-square" aria-hidden="true"></i> Registrar Observación</b>
		                        	</button>
		                        	<br>

		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                        		<b><i class="fa fa-clock-o" aria-hidden="true"></i> 
		                          		{{$variable = $p->fecha_cierre != '' ? 'Cambiar fecha cierre proceso' : 'Asignar fecha cierre proceso'}}</b>
		                        	</button>
		                        	<br>
		                        	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verobservacionesproceso{{$p->id}}">
		                          		<b><i class="fa fa-sticky-note" aria-hidden="true"></i> Ver observaciones </b>
		                        	</button>
		                        	<br>
		                        	<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cambiarestadoproceso{{$p->id}}">
		                          		<b><i class="fa fa-refresh" aria-hidden="true"></i> Cambiar estado</b>
		                        	</button>
		                        	<br>
		                        @else
			                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#registrarproceso{{$p->id}}">
			                          		<b><i class="fa fa-pencil-square" aria-hidden="true"></i> Registrar Observación</b>
			                        </button>
			                        <br>
		                        	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editarproceso{{$p->id}}">
		                          		<b><i class="fa fa-user-plus" aria-hidden="true"></i> Cambiar usuario</b>
		                        	</button>
		                        	<br>
		                        	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fechacierreproceso{{$p->id}}">
		                        		<b><i class="fa fa-clock-o" aria-hidden="true"></i> 
		                          		{{$variable = $p->fecha_cierre != '' ? 'Cambiar fecha cierre proceso' : 'Asignar fecha cierre proceso'}}</b>
		                        	</button>
		                        	<br>
		                        	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verobservacionesproceso{{$p->id}}">
		                          		<b><i class="fa fa-sticky-note" aria-hidden="true"></i> Ver observaciones</b>
		                        	</button>
		                        	<br>
		                        	<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cambiarestadoproceso{{$p->id}}">
		                          		<b><i class="fa fa-refresh" aria-hidden="true"></i> Cambiar estado</b>
		                        	</button>
		                        @endrole
		                        <!-- Modal -->
		                        
		                    </td>
		                   </tr>
		                @empty
		                    <tr >      
		                      <td class="text-center"><strong><h4>Aún no existen procesos registrados o asignados a este usuario</h4></strong></td>
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
					<!--MODAL PARA REGISTRAR UNA OBSERVACION-->
						@include('partials.registrarproceso')
					<!--/MODAL PARA REGISTRAR UNA OBSERVACION-->	                           
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
                    //responsive: true,
                    stateSave: true,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    language:
                      {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ procesos",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando procesos del _START_ al _END_ de un total de _TOTAL_ procesos",
                        "sInfoEmpty":      "Mostrando procesos del 0 al 0 de un total de 0 procesos",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ procesos)",
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
                filtro_url('#procesos-table');


            });


          </script>


@endsection
@include('partials.scripts')