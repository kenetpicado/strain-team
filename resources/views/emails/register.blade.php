@extends('emails.layout')

@section('body')
    <div style="text-align: center;">
        <img src="https://i.postimg.cc/7YjRw6hM/Welcome-amico.png" alt="" style="width: 200px">
    </div>
    <span class="text-header">Hola, {{ $name }}!</span>
    <div class="my-22">
        Has sido registrado exitosamente en {{ config('app.name') }}, y estamos emocionados de darte la bienvenida a nuestra
        comunidad.
    </div>

    @isset($password)
        <div class="my-22">
            A continuación, encontrarás tus credenciales de acceso:
        </div>
        <div class="my-22">
            <ul>
                <li style="margin-bottom: 1rem">
                    Correo: <span class="badge-primary">{{ $email  }}</span>
                </li>
                <li>
                    Contraseña: <span class="badge-primary">{{ $password }}</span>
                </li>
            </ul>
        </div>
        <div class="my-22">
            Te recomendamos que, una vez que inicies sesión, actualices esta contraseña temporal por una que te
            resulte más segura y personal.
        </div>
        <div class="my-22">
            Para comenzar, puedes descargar la aplicación desde el siguiente enlace:
        </div>
        <div style="text-align: center">
            <a href="https://play.google.com/store/games?hl=es&gl=US" target="_blank">
                <img src="https://i.postimg.cc/NjHRvG2X/googleplay.png" alt="" style="width: 200px">
            </a>
        </div>
    @endisset

    <div class="my-22">
        Si en algún momento tienes preguntas, necesitas ayuda o deseas compartir tus comentarios, nuestro equipo de soporte
        estará encantado de asistirte.
    </div>
    <p>
        No dudes en ponerte en contacto con nosotros a través de
        <a href="mailto:{{ config('mail.from.support') }}" target="_blank">{{ config('mail.from.support') }}</a>
    </p>
@endsection
