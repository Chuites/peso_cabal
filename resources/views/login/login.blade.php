<!DOCTYPE html>
<html>

<head>
    <title>Login de la Asociación de Agricultores</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>
    <div class="container">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo de la Asociación de Agricultores">
        <h1>Login de la Asociación de Agricultores</h1>
        <form id="login-form" method="POST">
            @csrf
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button id="btn_iniciar_sesion">Inciar sesion</button>
            <div class="error">Nombre de usuario o contraseña incorrectos.</div>
        </form>

    </div>
</body>

</html>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $("#btn_iniciar_sesion").click(function(e) {
        alert('captura click');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('login') }}",
            data: $('#login-form').serialize(),
            dataType: "json",
            success: function(data) {
                // Redireccionar a la página de inicio después de un inicio de sesión exitoso
                window.location.href = "{{ route('welcome') }}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Mostrar mensaje de error al usuario
                //$('#error-message').text(jqXHR.responseJSON.error);
                console.log(jqXHR.responseJSON.error);
            }
        });
    });
</script>
