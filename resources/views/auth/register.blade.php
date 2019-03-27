@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de usuarios</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombres</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                
                                <select class="form-control"  name="rol" id="exampleFormControlSelect1">
                                  @forelse ($roles as $r)
                                    <option id="{{$r->name}}">{{$r->name}}</option>
                                  @empty
                                    <option>No hay roles</option>
                                  @endforelse
                                </select>

                                @if ($errors->has('empresa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('empresa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Empresa</label>

                            <div class="col-md-6">
                                
                                <select class="form-control"  name="empresa" id="exampleFormControlSelect1">
                                  @forelse ($empresas as $e)
                                    <option id="{{$e->id}}">{{$e->nombre_empresa}}</option>
                                  @empty
                                    <option>aun sin registrar empresas</option>
                                  @endforelse
                                </select>

                                @if ($errors->has('empresa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('empresa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <div class=" text-center">
                                <span class="text-info">Las credenciales de accesos seran enviadas a el correo electrónico registrado</span>    
                            </div>
                            
                        </div>    
                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
