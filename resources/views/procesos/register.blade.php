@extends('layouts.app')
@section('header')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
    	<div class="col-10 col-md-10 col-sm-10 col-md-offset-1 col-offset-1 responsive" >
        	
	         <div class="list-group ">
			  <a href="#" class="list-group-item active"><h1>Instrucciones <h6>Sigue estos <strong>5 simples pasos</strong> para agregar los procesos correctamente.</h6></h1></a>
			  <a href="{{asset('archivos/plantilla/Control Procesos Estatales Plantilla.xlsx')}}" class="list-group-item list-group-item-info"> 1- Descarga la plantilla <small class="text-red">(Dando clic aquí)</small>.</a>
			  <a href="https://www.contratos.gov.co/consultas/inicioConsulta.do" target="_blank" class="list-group-item list-group-item-light"> 2- Ingresa a el sitio web contratos.gov.co <small class="text-success">(Puedes acceder danco clic aquí)</small>.</a>
			  <a href="#" class="list-group-item list-group-item-info"> 3- Filtra y copia en el navegador, luego de esto pega en las casillas del archivo de excel no olvides que deben tener el mismo orden y no pueden quedar filas incompletas.</a>
			  
			  	
			  	@role('Comerciante')
			  		
			  	@else
			  		<a href="#" class="list-group-item list-group-item-light"> 
			  		4- Selecciona una empresa y un usuario para asignar los procesos.
			  		</a>
			  	@endrole

			  
			  	@role('Comerciante')
			  		 <a href="#" class="list-group-item "> 4- Arrastra o da clic en el rectangulo para subir tu archivo, esto puedo tardar un poco, recuerda que no se agregaran a la base de datos procesos repetidos.</a>
			  	@else
			  		<a href="#" class="list-group-item list-group-item-info">
			  			5- Selecciona una empresa y un usuario para asignar los procesos.
			  		</a>
			  	@endrole
			 
			  	@role('Comerciante')
			  		<a href="{{route('consultar_procesos')}}" class="list-group-item  list-group-item-info" > 5- Consulta los procesos <small class="text-info">(Ver procesos)</small>.</a>
			  	@else
			  		<a href="{{route('consultar_procesos')}}" class="list-group-item list-group-item-light" > 6- Consulta los procesos <small class="text-info">(Ver procesos)</small>.</a>
			  	@endrole


			</div> 
        </div>
        <div class="col-md-10 col-md-offset-1">
        	
        	<!--SELECCION DE UN USUARIO-->
        	@role('Comerciante')

        		<input type="hidden" id="selEmpresa" value="{{$empresas[0]->id}}"/>
	        		Tu empresa asignada es: <h4 class="text-info"><strong> {{$empresas[0]->nombre_empresa}}<strong></h4>
	        	
        	@else
        		@role('Super-Admin')
	        		<div>
		        		<label>Selecciona una empresa</label>
			        	<select class="form-control" id="selEmpresa" >
			        		<option value="">SELECCIONA UNA EMPRESA</option>
			        		@forelse($empresas as $e)
			        			<option value="{{$e->id}}">{{$e->nombre_empresa}}</option>
			        		@empty
			        		
			        		@endforelse
			        	</select>
	        		</div>
        		@else
        			<div>
		        		<label>Selecciona una empresa</label>

			        	<select class="form-control" id="selEmpresa" >
			        		@forelse($empresas as $e)
			        			<option value="{{$e->id}}">{{$e->nombre_empresa}}</option>
			        		@empty
			        		
			        		@endforelse
			        	</select>
	        		</div>
        		@endif

        	@endrole

        	<!--SELECCION DE UN USUARIO-->
        	@role('Comerciante')

        		<input type="hidden" id="selUsuario" value="{{$usuarios->id}}"/>
	        		
	        	
        	@else
        		<div>
        			<label>Selecciona un usuario</label>
		        	<select class="form-control" id="selUsuario" name="usuario">
		        		<option value="">SELECCIONA UN USUARIO</option>
		        		@forelse($usuarios as $u)
		        			<option value="{{$u->id}}">{{$u->name}} {{$u->getRoleNames()[0]}}</option>
		        		@empty
		        		
		        		@endforelse
		        	</select>
        		</div>

        	@endrole	
          	<div>
          		<br>
          		<div class="dropzone"></div>
          		<span id="spmsn" class="text-green"></span>	
          		
          	</div>
          	
        </div>
        <br>
        
       

		
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function() {
        $('#selEmpresa').select2();

        $('#selUsuario').select2();

     });
	var usuario =$('#selUsuario').val();
	var empresa ="1";
	var ur="../admin/subir_procesos";

	Dropzone.autoDiscover=false;

	$('.dropzone').dropzone ({ 
		url: ur, 
		acceptedFiles:'application/csv,application/excel,application/vnd.ms-excel, application/vnd.msexcel,text/csv, text/anytext, text/plain, text/x-c,text/comma-separated-values,inode/x-empty,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		maxFilesize:5,
		maxFiles:1,
		dictDefaultMessage:'Arrastra o da clic aquí para subir tus archivos, recurda que deben ser archivos excel, solo se permite la carga de un (1) archivo.',
		headers:{
			'X-CSRF-TOKEN':'{{ csrf_token()}}'
		},
		init: function() { 
		this.on("sending", function(file, xhr, formData){ 
			formData.append("usuario", usuario);
			formData.append("empresa", $('#selEmpresa').val()); }), 
		this.on("success", function(file, xhr){ 

			document.getElementById("spmsn").innerHTML=xhr.mensaje; }),
		this.on('error',function(file,error){
			console.log(error);
			$('.dz-error-message > span').text(error.file[0]);})
				 
		}, 
	}); 

</script>

@endsection