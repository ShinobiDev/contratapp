@component('mail::message')



{{-- ![logo](http://metalbit.co/core/img/AzulMetalicoHor.png) --}}


##El procesos {{$datos->numero_proceso}}, esta próximo a finalizar##

@component('mail::table')
    | Proceso | Usuario asignado | Fecha cierre |
    |:--------|:----------|
    | {{$datos->numero_proceso}} | {{$datos->usuario->name}} | {{$datos->fecha_cierre}} |
@endcomponent

@component('mail::button', ['url' => route('consultar_procesos').'?id='.trim($datos->numero_proceso)])
ver proceso
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
