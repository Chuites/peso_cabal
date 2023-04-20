<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style></style>
    <style>@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}</style>
    <script>

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

        $("#btntestconexion").click(function(e){
            let datos;
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "POST",
                    url: "{{route('TestApi')}}",
                    data: { "id": "testid" },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        let test = data;

                        alert(data.mensaje);
                        //toastr.error(data, 'test');
                        console.log(test.mensaje);


                        console.log(data.mensaje);
                    },
                    error: function(data){
                        alert("Web Service No Responde");
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
                    success: function(response) {
                        alert(response);
                        console.log(response);
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
        });
        $("#btn_crear_cuenta").click(function(e){
            document.getElementById("bienvenida").style.display = "none";
            document.getElementById("datos_cuenta").style.display = "block";
            document.getElementById("datos_envio").style.display = "none";
            document.getElementById("test_conexion").style.display = "none";
        });
        $("#btn_crear_cuenta2").click(function(e){
            document.getElementById("bienvenida").style.display = "none";
            document.getElementById("datos_cuenta").style.display = "block";
            document.getElementById("datos_envio").style.display = "none";
            document.getElementById("test_conexion").style.display = "none";
        });
        $("#btn_inicio").click(function(e){
            document.getElementById("bienvenida").style.display = "block";
            document.getElementById("datos_cuenta").style.display = "none";
            document.getElementById("datos_envio").style.display = "none";
            document.getElementById("test_conexion").style.display = "none";
        });
        $("#btn_realizar_envios").click(function(e){
            document.getElementById("bienvenida").style.display = "none";
            document.getElementById("datos_cuenta").style.display = "none";
            document.getElementById("datos_envio").style.display = "block";
            document.getElementById("test_conexion").style.display = "none";
        });


    });

    </script>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://lacasadelagricultor.com.gt/wp-content/uploads/2020/04/5.png" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name" id="btn_inicio">Agricultor</span> </a>
                <div class="nav_list"> <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name" id="btn_test_conexion">Prueba de Conexion</span> </a> <a class="nav_link"> <i class='bx bx-user nav_icon'></i>
                    <span class="nav_name" id="btn_crear_cuenta">Crear Cuenta</span> </a> <a class="nav_link"> <i class='bx bx-user nav_icon'></i>
                    <span class="nav_name" id="btn_realizar_envios">Realizar Envios</span> </a> <a href="#" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i>
                    <span class="nav_name" id="btn_traking">Traking</span> </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Bienvenida -->
    <div class="height-100 bg-light" style="padding: 2%;" id="bienvenida">
        <h3 class="center">AGRICULTORES UNIDOS</h3>
        <br>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://img.freepik.com/fotos-premium/hombre-latino-recogiendo-granos-cafe-dia-soleado-agricultor-cafe-cosechando-granos-cafe-brasil_63135-1755.jpg?w=2000" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://uncafeci.to/wp-content/uploads/2021/08/guatemala-cafe-historia-origen-sabores-1080x675.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://perfectdailygrind.com/es/wp-content/uploads/sites/2/2019/11/productores-de-cafe-en-el-salvador.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <br>
    </div>
    <!-- Termina Bienvenida -->

    <!-- TEST DE CONEXION -->
    <center>
        <div class="height-100 bg-light" style="padding:7%;" id="test_conexion">
            <h3 class="center">PRUEBA DE CONECCIÓN</h3>
            <form class="row g-4 needs-validation" novalidate>
                <div class="col-12">

                    <button class="btn btn-primary" id="btntestconexion" name="btntestconexion">Enviar Prueba</button>
                </div>
            </form>
        </div>
    </center>
    <!-- Termina TEST DE CONEXION -->

    <!-- Datos de Cuenta -->
    <div class="height-100 bg-light" style="padding:7%;" id="datos_cuenta">
        <h3>DATOS DE CUENTA</h3>
        <form class="row g-4 needs-validation" novalidate id="frm_crear_cuenta">
            <div class="col-md-12">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca su nombre completo" required>
            </div>
            <div class="col-md-6">
                <label for="dpi" class="form-label">DPI</label>
                <input type="number" class="form-control" id="dpi" name="dpi" placeholder="Introduzca su numero de DPI" required>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Introduzca su numero de telefono" required>
            </div>
            <div class="col-md-12">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su direccion" required>
            </div>
            <div class="col-md-6">
                <label for="correo" class="form-label">Correo</label>
                <input type="mail" class="form-control" id="correo" name="correo" placeholder="Ingrese su direccion de correo electronico" required>
            </div>
            <div class="col-md-6">
                <label for="nit" class="form-label">Nit</label>
                <input type="number" class="form-control" id="nit" name="nit" placeholder="Ingrese su NIT" required>
            </div>
            <div class="col-12">
                <a href="#" class="btn btn-primary" id="btnCrearCuenta" name="btnCrearCuenta">Crear Cuenta</a>
            </div>
        </form>
    </div>
    <!-- Termina Datos de Cuenta -->

    <!-- Datos de Envio -->
    <div class="height-100 bg-light" style="padding:7%;" id="datos_envio">
        <h3>DATOS DE ENVIO</h3>
        <hr>
        <center><h4>Datos del Transporte</h4></center>
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Nombre del Piloto</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Introduzca su nombre completo" required>
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label">Numero de Licencia</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Introduzca su numero de licencia" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Numero de Placa</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Introduzca el numero de placa del transporte" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Marca</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Introduzca la marca del transporte" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Color</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Introduzca el color del transporte" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Introduzca el modelo del transporte" required>
            </div>
            <hr>
            <center><h4>Datos del Cargamento</h4></center>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Peso total</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Ingrese el peso total en libras del cargamento" required>
            </div>
            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">Parcialidades</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Ingrese el numero de parcialidades" required>
            </div>
            <center><button class="btn btn-primary">Enviar Carga</button></center>
            <br>
            <br>
        </form>
    </div>
    <!-- Termina Datos de Envio -->
</body>
</html>
