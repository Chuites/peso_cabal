<script>
    $(document).ajaxStart(function() {
        $('#loading-overlay').show();
    });

    $(document).ajaxStop(function() {
        $('#loading-overlay').hide();
    });

document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))

    document.getElementById("bienvenida").style.display = "block";
    document.getElementById("datos_cuenta").style.display = "none";
    document.getElementById("datos_envio").style.display = "none";
    document.getElementById("test_conexion").style.display = "none";
    document.getElementById("test_transporte").style.display = "none";
    document.getElementById("test_piloto").style.display = "none";

    $("#btntestconexion").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('TestApi')}}",
                data: { "id": "testid" },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    console.log(data.mensaje);
                    alert(data.mensaje);
                },
            });
    });

    $("#btntesttransporte").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('testTransporte')}}",
                data: {
                    placa: $("#placa").val()
                },
                success: function(data) {
                    if(data[0] != null)
                    {
                        alert(data[0]);
                    }else{
                        alert(data.mensaje);
                        console.log(data.mensaje);
                    }
                },
                error: function(data){
                    console.log(data);
                    alert('error');
                }
            });
    });

    $("#btntestpiloto").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('testPiloto')}}",
                data: {
                    dpi_piloto: $("#dpi_piloto").val()
                },
                success: function(data) {
                    if(data[0] != null)
                    {
                        alert(data[0]);
                    }else{
                        alert(data.mensaje);
                        console.log(data.mensaje);
                    }
                },
                error: function(data){
                    console.log(data);
                    alert('error');
                }
            });
    });

    $("#btnEnviarCargamento").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("enviarCargamento") }}',
            type: 'POST',
            data: {
                nombre: $('#nombre').val(),
                dpi: $('#dpi').val(),
                telefono: $('#telefono').val(),
                direccion: $('#direccion').val(),
                correo: $('#correo').val(),
                nit: $('#nit').val()
            },
            dataType: 'json',
            success: function(data) {
                    if(data[0] != null)
                    {
                        alert(data[0]);
                    }else{
                        alert(data.mensaje + '\n' + 'ID de Cuenta: '+ data.id_cuenta);
                        console.log(data.mensaje);
                    }
                },
            error: function(response){
                alert(response);
                console.log(response);
            }
        });
    });

    $("#btnCrearCuenta").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("crearCuenta") }}',
            type: 'POST',
            data: {
                nombre: $('#nombre').val(),
                dpi: $('#dpi').val(),
                telefono: $('#telefono').val(),
                direccion: $('#direccion').val(),
                correo: $('#correo').val(),
                nit: $('#nit').val()
            },
            dataType: 'json',
            success: function(data) {
                    if(data[0] != null)
                    {
                        alert(data[0]);
                    }else{
                        alert(data.mensaje + '\n' + 'ID de Cuenta: '+ data.id_cuenta);
                        console.log(data.mensaje);
                    }
                },
            error: function(response){
                alert(response);
                console.log(response);
            }
        });
    });

    $("#btn_test_conexion").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "block";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_crear_cuenta").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "block";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_crear_cuenta2").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "block";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_inicio").click(function(e){
        document.getElementById("bienvenida").style.display = "block";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_realizar_envios").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "block";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_test_transporte").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "block";
        document.getElementById("test_piloto").style.display = "none";
    });
    $("#btn_test_piloto").click(function(e){
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "block";
    });
});

</script>
