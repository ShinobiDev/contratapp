@extends('layouts.app')
@section('header')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
    	<div class="col-10 col-md-10 col-sm-10 col-md-offset-1 col-offset-1 responsive" >
        	
	         <div class="list-group ">
			  <a href="#" class="list-group-item active"><h2 class="text-white"><b>Instrucciones</b> <h4><b>Sigue estos</b> <strong class="text-orange"><b >@role('Comerciante') 5 @else 6 @endrole </strong> simples pasos para agregar los procesos correctamente.</b></h4></h2></a>
			  
			  <a href="{{asset('archivos/plantilla/Control Procesos Estatales Plantilla.xlsx')}}" class="list-group-item list-group-item-ligth"> <span class="text-red">1-</span> Descarga la plantilla <small class="text-red">(Dando clic aquí)</small>.</a>
			  
			  <a href="https://www.contratos.gov.co/consultas/inicioConsulta.do" target="_blank" class="list-group-item list-group-item-info"> <span class="text-red">2-</span> Ingresa a el sitio web contratos.gov.co <small class="text-red">(Puedes acceder danco clic aquí)</small>.</a>

			  <a href="#" class="list-group-item list-group-item-ligth"> <span class="text-red">3-</span> Filtra y copia en el navegador, luego de esto pega en las casillas del archivo de excel no olvides que deben tener el mismo orden y no pueden quedar filas incompletas.(debes usar LIBRE OFFICE y guardar este archivo como formato excel 2007-2019)</a>
			  
			  	
			  	@role('Comerciante')
			  		
			  	@else
			  		<a href="#" class="list-group-item list-group-item-info"> 
			  		<span class="text-red">4-</span> Selecciona una empresa y un usuario para asignar los procesos.
			  		</a>
			  	@endrole

			  
			  	@role('Comerciante')
			  		 <a href="#" class="list-group-item list-group-item-info"> <span class="text-red">4-</span> Arrastra o da clic en el rectangulo para subir tu archivo, esto puedo tardar un poco, recuerda que no se agregaran a la base de datos procesos repetidos.</a>
			  	@else
			  		
			  		
			  		<a href="#" class="list-group-item list-group-item-ligth"> <span class="text-red">5-</span> Arrastra o da clic en el rectangulo para subir tu archivo, esto puedo tardar un poco, recuerda que no se agregaran a la base de datos procesos repetidos.</a>
			  		
			  	@endrole
			 
			  	@role('Comerciante')
			  		<a href="{{route('consultar_procesos')}}" class="list-group-item  list-group-item-ligth" > <span class="text-red">5-</span> Consulta los procesos <small class="text-red">(Ver procesos)</small>.</a>
			  	@else
			  		<a href="{{route('consultar_procesos')}}" class="list-group-item list-group-item-info" > <span class="text-red">6-</span> Consulta los procesos <small class="text-red">(Ver procesos)</small>.</a>
			  	@endrole


			</div> 
        </div>
        <div class="col-md-10 col-md-offset-1">
        	
        	<!--SELECCION DE UN USUARIO-->
        	@role('Comerciante')

        		<input type="hidden" id="selEmpresa" value="{{$empresas[0]->id}}"/>
	        		Tu empresa asignada es: <h3 class="text-red"><strong> {{$empresas[0]->nombre_empresa}}<strong></h3>
	        	
        	@else
        		@role('Super-Admin')
	        		<div>
		        		<label class="text-red">Selecciona una empresa</label>
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
		        		<label class="text-red">Selecciona una empresa</label>

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
        			<label class="text-primary">Selecciona un usuario</label>
		        	<select class="form-control" id="selUsuario" name="usuario">
		        		<option value="">SELECCIONA UN USUARIO</option>
		        		@forelse($usuarios as $u)
		        			<option value="{{$u->id}}">{{$u->name}} {{$u->getRoleNames()[0]}}</option>
		        		@empty
		        		
		        		@endforelse
		        	</select>
        		</div>

        	@endrole	
          	<div class="bg-info" style="margin-top: 25px">
          		
          		<div  class="dropzone text-red" style="width: 75%; margin-left: 15%"></div>
          		<span id="spmsn" style="display: none" class="text-green"></span>	
          		
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
        
        @role('Comerciante')

		@else
			$('#selEmpresa').select2();
        	$('#selUsuario').select2();
        	$('#selEmpresa').on("change",function(){
        		 document.getElementById("select2-selUsuario-container").innerHTML="";
        		 document.getElementById("selUsuario").innerHTML="";
        		 var url="{{config('app.url')}}"+"/admin/ver_usuario_empresa/"+this.value;
        	
        		  $.ajax( url )
				  .done(function(data) {
				    $.each(data,function(key, registro) {
				    	document.getElementById("selUsuario").innerHTML="";
				    	$("#selUsuario").append('<option value="0">Selecciona un usuario</option>');	
				    	registro.forEach(function(r){
				    		console.log(r);
				    		$("#selUsuario").append('<option value='+r.id+'>'+r.name+'</option>');	
				    	});
				        
				      });  
				  })
				  .fail(function() {
				    
				  });
				  
        	});


        	$('#selUsuario').on("change",function(){
        		usuario =$('#selUsuario').val();
				  
        	});


		@endrole
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
		dictDefaultMessage:'Arrastra o da clic aquí para subir tus archivos, recuerda que deben ser archivos excel, solo se permite la carga de un (1) archivo.',
		headers:{
			'X-CSRF-TOKEN':'{{ csrf_token()}}'
		},
		init: function() { 
			
		this.on("sending", function(file, xhr, formData){ 
			mostrar_cargando("spmsn",30,"Estamos registrado los procesos");
			formData.append("usuario", usuario);
			formData.append("empresa", $('#selEmpresa').val()); }), 
		this.on("success", function(file, xhr){ 

			document.getElementById("spmsn").innerHTML=xhr.mensaje;
			document.getElementById("spmsn").classList.add('text-red');
			document.getElementById(el).style.display='';
			this.removeAllFiles(true);	 }),
		this.on("complete", function(file, xhr){ 

			 this.removeAllFiles(true);
			 }),
		this.on('error',function(file,error){
			console.log(error);
			$('.dz-error-message > span').text(error.file[0]);})
				 
		}, 
	}); 
	/**
         * [funcion para mostrar cargando luego de enviar la peticion a el servidor]
         * @param  {[type]} el [description]
         * @return {[type]}    [description]
     */
    function mostrar_cargando(el,width,msn){
      document.getElementById(el).style.display='';	
      $('#'+el).html('<div class="loading text-red"><img src="https://k46.kn3.net/taringa/C/7/8/D/4/A/vagonettas/5C9.gif" width="'+width+'" alt="loading" /><br/>'+msn+'</div>');
    }
</script>

@endsection