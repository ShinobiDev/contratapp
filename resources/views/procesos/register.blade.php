@extends('layouts.app')
@section('header')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          	<div class="dropzone"></div>
        </div>

		
    </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
	var empresa=1;
	var usuario '{{auth()->user()->id}}';

	var ur="../admin/subir_procesos/"+empresa+"/"+usuario;
	
	var mydropzone=new Dropzone('.dropzone',{
		url:ur,
		acceptedFiles:'application/csv,application/excel,application/vnd.ms-excel, application/vnd.msexcel,text/csv, text/anytext, text/plain, text/x-c,text/comma-separated-values,inode/x-empty,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		maxFilesize:5,
		maxFiles:1,
		dictDefaultMessage:'Arrastra o da clic aquí para subir tus archivos, recurda que deben ser  archivos excel',
		headers:{
			'X-CSRF-TOKEN':'{{ csrf_token()}}'
		}

	});

	
	mydropzone.on('error',function(file,error){
		console.log(error);
		$('.dz-error-message > span').text(error.file[0]);
	});
	Dropzone.autoDiscover=false;
</script>
@endsection