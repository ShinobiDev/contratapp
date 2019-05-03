@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading">Panel administrativo</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenid@, {{auth()->user()->name}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
