<style>
    .cargamento-status {
    text-align: center;
    margin-top: 50px;
}

.status-icon {
    font-size: 50px;
    margin-top: 20px;
}
</style>
<div class="height-100 bg-light" style="padding:7%;" id="traking_div">

    <h3>TRACKING</h3>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" id="id_cargamento_estado" name="id_cargamento_estado" placeholder="Ingrese el id del cargamento" required>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary form-control" id="btnEnviarParcialidad" name="btnEnviarParcialidad">Consultar Estado</a>
        </div>
    </div>
    <br>
    <br>
    <div class="cargamento-status">
        <h1>Estado del Cargamento</h1>

        <div class="status-icon">
            <i class='bx bx-box'></i>
            <i class='bx bx-archive-in'></i>
            <i class='bx bx-archive-out'></i>
            <i class='bx bx-loader-alt'></i>
            <i class='bx bx-check-circle'></i>
        </div>
    </div>

</div>
