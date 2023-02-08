<?php $__env->startSection('content'); ?>
<style type="text/css">
    .requerido:after {
        content: " *"; color: red;
    }
    #listadoTabla th {
        background-color: #337ab7;
        color: #fff;

        font-weight: bold;
    }
    .listadoTabla th {
        background-color: #337ab7;
        color: #fff;
    }

    .listadoTabla thead {
        background-color: #337ab7;
        color: #fff;
    }
</style>

<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row " align="center" style="padding: 10px;">
                        <img src="<?php echo e(asset('img/min_gob.png')); ?>" width="500" height="200"><br><br>
                        <h1>Citas en Línea</h><br><br>
                        <button class="btn btn-success" id="btnCita" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agendar cita</button>
                        <br>
                        <a href="#" id="btn_bsolicitud" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;Buscar Solicitud</a>
                    </div>
                </div>
            </div>
    </div>
</div>


<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_bsolicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda | <small id="modalSubtitle">Solicitud</small></h4>
            </div>
            <div class="modal-body">
                <center>
                    <form id="">
                        <div class="row">
                            <label for="cui_busqueda">Ingere su numero de DPI</label>
                            <input type="number" name="cui_busqueda" id="cui_busqueda">
                        </div>
                    </form>

                <div id="contenedor">
                    <input type="hidden" id="token" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-bordered table-striped" id="listadoTabla">
                                    <thead>
                                        <th class="dt-head-center">Gestion</th>
                                        <th class="dt-head-center">DPI</th>
                                        <th class="dt-head-center">Tipo de Solicitud</th>
                                        <th class="dt-head-center">Fecha Solicitud</th>
                                        <th class="dt-head-center">Horario</th>
                                        <th class="dt-head-center" width="105">Acciones</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer centrado_vertical">
                &nbsp;
                <a href="#" id="btn_buscarsolicitud" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Buscar</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo e(Html::style('sources/DataTables-1.10.12/css/jquery.dataTables.css')); ?>

<?php echo e(Html::script('sources/DataTables-1.10.12/js/jquery.dataTables.js')); ?>

<?php echo e(Html::script('sources/DataTables-1.10.12/js/dataTables.bootstrap.min.js')); ?>

<?php echo e(Html::script('js/toastr.js')); ?>

<?php echo e(Html::style('css/toastr.css')); ?>

    <script type="text/javascript">
        $("#btnCita").click(function(){
            window.location="<?php echo e(route('solicitudIndex')); ?>";
        });

        $("#btn_bsolicitud").click(function(){
            $("#modal_bsolicitud").modal('show');
        });

        $('#btn_buscarsolicitud').click(function(){
            if ($("#cui_busqueda").val() != "") {
                $("#listadoTabla").dataTable().fnDestroy();
                ruta = "<?php echo e(route('buscarSolicitud')); ?>" + '/' + $("#cui_busqueda").val();
                // CARGA DE DATOS EN LA LISTA
                $('#listadoTabla').DataTable({
                    columnDefs: [
                        { className: "dt-body-center", targets: [ 1 ]}
                    ],
                    language: {
                        url: "<?php echo asset('sources/DataTables-1.10.12/languages/Spanish.json'); ?>"
                    },
                    order: [1,'asc'],
                    bFilter : false, //oculta filtros
                    paging: false,
                    lengthMenu: <?php echo e(config('constantes.datatableListRows')); ?>,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: ruta,
                        type: 'POST',
                        data : function (d) {
                            d._token = $("#token").val();
                            d.criterio = $("#criterio").val();
                        }
                    },
                });
            }else{
                toastr.error('Ingrese su numero de DPI')
            }
        });

        let identificadorTiempoDeEspera;
        function temporizadorDeRetraso() {
            identificadorTiempoDeEspera = setTimeout(imprimir, 2000);
        };
        function imprimir() {
            toastr.success('Boleta desacargada correctamente')
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>