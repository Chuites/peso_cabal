<div class="height-100 bg-light" style="padding:7%;" id="listado_pesaje">
    <h3>Certificar pesaje</h3>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <input type="number" class="form-control" id="id_parcialidad" name="id_parcialidad" placeholder="Ingrese numero de parcialidad" required>
        </div>
        <div class="col-md-6">
            <input type="number" class="form-control" id="peso_certificado" name="peso_certificado" placeholder="Ingrese peso certificado" required>
        </div>
    </div>
    <br>
    <center>
        <a href="#" class="btn btn-primary form-control" style="width: 20%" id="btnCertificarPeso" name="btnCertificarPeso"><i class='bx bx-check-double'></i>&nbsp;Certificar Peso</a>
    </center>
    <br>
    <br>
    <center>
        <h3 class="center">COLA DE CAMIONES POR PESAR</h3>
    </center>
    <br>
    <div id="listadoCargamentos">
        <table class="table table-striped table-dark" id="tabla-dinamica">
            <thead>
                <tr>
                    <th scope="col">Número de Parcialidad</th>
                    <th scope="col">Placa del Camión</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Color</th>
                    <th scope="col">Peso en Libras</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
