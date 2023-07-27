@extends('emails.layout')

@section('body')
    <div style="text-align: center;">
        <img src="https://i.postimg.cc/63YM6rr5/Forgot-password-rafiki.png" alt="" style="width: 200px">
    </div>
    <span class="text-header">Hola, {{ $name }}!</span>
    <div class="my-22">
        Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.
    </div>
    <div class="my-22">
        Tu nueva contraseña es: <span class="badge-primary">{{ $password }}</span>
    </div>
    <div class="my-22">
        Por favor, cambia tu contraseña una vez que hayas iniciado sesión.
    </div>
@endsection
