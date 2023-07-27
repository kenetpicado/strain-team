@extends('emails.layout')

@section('body')
    <div style="text-align: center;">
        <img src="https://i.postimg.cc/63YM6rr5/Forgot-password-rafiki.png" alt="" style="width: 200px">
    </div>
    <span class="text-header">Hola, {{ $name }}!</span>
    <div class="my-22">
        Hemos procesado exitosamente tu solicitud de restablecimiento de contraseña Queremos asegurarnos de que puedas
        acceder nuevamente a tu cuenta de manera segura y sin problemas.
    </div>
    <div class="my-22">
        A partir de ahora, tu nueva contraseña temporal es: <span class="badge-primary">{{ $password }}</span>
    </div>
    <div class="my-22">
        Te recomendamos que, una vez que inicies sesión, actualices esta contraseña temporal por una que te
        resulte más segura y personal.
    </div>
    <div>
        Si no solicitaste este restablecimiento de contraseña o tienes alguna preocupación sobre la seguridad de tu cuenta,
        por favor <a href="mailto:{{ config('mail.from.support') }}" target="_blank">contáctanos de inmediato.</a> Estamos aquí para ayudarte
        en cualquier problema o duda que puedas tener.
    </div>
@endsection
