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
