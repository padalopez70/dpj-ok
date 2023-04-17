<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <title>{{config('app.name')}}</title>
    <style>
        @media only screen and (max-width: 600px) {
            .contenedor {
                width: 100%!important;
            }
        }

        @media only screen and (min-width: 600px) {
            .contenedor {
                width: 600px!important;
                padding: 2em!important;
                margin: auto!important;
                width: 50%!important;
            }
        }

        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background-color: #edf2f7;
            font-family: "Open Sans", sans-serif;
            font-style: normal;
            font-size: 1em;
            font-weight: 400;
        }

        ul {
            list-style: none;
        }

        ul li::before {
            content: "\2022";
            color: #2d3748;
            font-weight: bold;
            display: inline-block;
            width: 0.7em;
            margin-left: -1em;
            font-size: 1.4em;
        }

        hr {
            margin-top: 2em;
            margin-bottom: 2em;
            color: #8780a3;
        }

        .titulo {
            width: 100%;
            color: rgb(235, 235, 237);
            text-align: center;
            background-color: rgb(69, 69, 72);
        }


        .recuadro {
            width: 100%;
            background-color: rgb(235, 235, 237);
            padding: 1em;
        }

        .hola {
            color: #2d3748;
            font-weight: bold;
            font-size: 1.5em;
            padding-bottom: 2em;
        }

        .mensaje {
            color: #8780a3;
        }

        .clave {
            margin: auto;
            width: 50%;
            height: 3.5em;
            line-height: 3.5em;
            text-align: center;
            background-color: #2d3748;
            color: white;
            font-weight: bold;
            width: 9em;
            height: 3.5em;
            border-radius: 5px;
            margin-bottom: 2em;
            font-size: 1em;
        }

        .footer {
            color: #8780a3;
            text-align: center;
            padding-top: 2em;
        }
    </style>
</head>

<body>

    <div class="contenedor">
        <div class="recuadro">
            <div class="titulo">
                <h1>{{config('app.name')}}</h1>
            </div>
            <div class="hola">¡Hola! {{$datos['usuario']->name}} </div>
            <div class="mensaje">
                <u>Se te ha creado un usuario:</u>
                <ul>
                    <li>Para: {{config('app.name')}}</li>
                    <li>De: {{$datos['organismo']}}</li>
                </ul>

                <br>

                <u>Para acceder a dicho sistema debes:</u>

                <br>

                <ul>
                    <li>Ingresar al Sitio: <a href="{{config('app.url')}}">{{config('app.url')}}</a></li>
                    <li>Tu Usuario: {{$datos['usuario']->email}}</li>
                    <li>La Clave de Acceso:</li>
                </ul>

                <div class="clave">{{$datos['clave']}}</div>

                Si bien esta clave es generada aleatoriamente, recuerda cambiarla
                con periodicidad para mantener tu cuenta segura.

                <hr>

                Si Ud. no es <b>{{$datos['usuario']->name}}</b> por favor borre este Correo Electrónico.
                El uso no autorizado puede ocasionarle problemas legales.

            </div>
        </div>
        <div class="footer"><small>© 2022 {{$datos['organismo']}}. Todos los derechos reservados.</small></div>
    </div>
</body>

</html>
