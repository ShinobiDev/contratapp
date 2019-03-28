@component('mail::message')



![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)


##Utiliza estas credenciales para acceder a {{config('app.name')}}##

@component('mail::table')
    | Usuario | Contraseña |
    |:--------|:----------|
    | {{$user->email}} | {{$datos}} |
@endcomponent

@component('mail::button', ['url' => url('login').'?id='.urlencode($user->email)])
Iniciar sesión
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
