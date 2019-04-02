@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-11 col-md-11">


			
			<form  method="POST" action="{{ route('editar_usuario',$usuario->id) }}">
              <div class="form-group">
                  {{ csrf_field() }}
              </div>  
              <div class="form-group">
                
                <label for="exampleInputName">Nombre usuario</label>
                <input type="text" name="name" class="form-control"   placeholder="Ingresa el nuevo nombre de la usuario" value="{{$usuario->name}}" required>
                
              </div>
              <div class="form-group">
                
                <label for="exampleInputEmail">Correo usuario</label>
                <input type="text" name="email" class="form-control"   placeholder="Ingresa el nuevo correo del usuario" value="{{$usuario->email}}" required>
                
              </div>

              <div class="form-group">
                
                <label for="exampleInputEmail">Ingresa una nueva contraseña solo si deseas cambiar la actual, en caso contrario deja el espacio en blanco.</label>
                
              </div>
              <div class="form-group">
                
                <label for="exampleInputEmail">Nueva Contraseña</label>
                <input type="password" name="password[]" class="form-control"  placeholder="Ingresa tu nueva contraseña" >
                
              </div>
               <div class="form-group">
                
                <label for="exampleInputEmail">Confirma nueva contraseña</label>
                <input type="password" name="password[]" class="form-control"   placeholder="Confirma tu contraseña" >
                
              </div>
              
               <button type="submit" class="btn btn-primary">Guardar cambios</button>   
            </form>
		    
        </div>
    </div>
</div>        	
@endsection
@section('scripts')
@endsection
