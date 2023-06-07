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
    document.getElementById("listado_pesaje").style.display = "none";
    document.getElementById("test_piloto").style.display = "none";

    $(document).ready(function() {

    });

    $("#btnCertificarPeso").click(function(e){
        if(($("#id_parcialidad").val() == '') && ($("#peso_certificado").val() == '')){
            alert('Debe llenar todos los campos');
        }else{
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('certificarPesoParcialidad')}}",
                data: {
                    id_parcialidad: $('#id_parcialidad').val(),
                    peso_certificado: $('#peso_certificado').val()
                },
                dataType: "json",
                success: function(data) {
                    var tbody = $('#tabla-dinamica tbody');
                    window.location = "{{ route('generarPDF') }}" + $("#id_parcialidad").val();
                },
            });
        }
    });

    $("#btn_listado_pesaje").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: modifyURLScheme("{{ route('listadoParcialidades') }}", "https"),
            //url: "{{ route('listadoParcialidades') }}",
            data: {
                "id": "testid"
            },
            dataType: 'json',
            success: function(data) {
                // Construir la tabla dinámica con los datos recibidos
                var tbody = $('#tabla-dinamica tbody');
                tbody.empty();
                // Recorrer los datos y agregar filas a la tabla
                $.each(data, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.id_parcialidad));
                    row.append($('<td>').text(data.placa));
                    row.append($('<td>').text(data.marca));
                    row.append($('<td>').text(data.color));
                    row.append($('<td>').text(data.peso));
                    tbody.append(row);
                });
            },
            error: function(data) {
                console.log(data);
                alert('Error al consultar los datos');
            }
        });
    });

    $("#logout").click(function(e){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('logout')}}",
            data: { "id": "testid" },
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data) {
                window.location = "{{ url('/') }}";
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

    $("#btn_inicio").click(function(e){
        document.getElementById("bienvenida").style.display = "block";
        document.getElementById("listado_pesaje").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";

    });
    $("#btn_listado_pesaje").click(function(e){
        document.getElementById("listado_pesaje").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";

    });
    $("#btn_test_piloto").click(function(e){
        document.getElementById("test_piloto").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("listado_pesaje").style.display = "none";

    });
});

</script>
