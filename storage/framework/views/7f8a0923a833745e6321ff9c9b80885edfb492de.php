<?php $__env->startSection('content'); ?>
<style type="text/css">
    .requerido:after {
        content: " *"; color: red;
    }
    #listadoTabla th {
        background-color: #229954;
        color: #fff;

        font-weight: bold;
    }
    .listadoTabla th {
        background-color: #229954;
        color: #fff;
    }

    .listadoTabla thead {
        background-color: #229954;
        color: #fff;
    }
</style>


<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Agendar Cita</h3>
                    <br>
                    <h3><strong>DATOS SOLICITANTE</strong></h3>
                    <br>
                    <form id="form_consulta">
                            <div class="row">
                                <div class="col-md-6" >
                                    <?php echo Form::label('Nombres', 'Nombres', ['class' => 'control-label requerido', 'id' => 'lb_nombres']); ?>

                                    <?php echo Form::text('nombres', '', array_merge(['class' => 'form-control', 'id' => 'nombres'])); ?>

                                </div>
                                <div class="col-md-6 ">
                                    <?php echo Form::label('Apellidos', 'Apellidos', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']); ?>

                                    <?php echo Form::text('apellidos', '', array_merge(['class' => 'form-control', 'id' => 'apellidos'])); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <?php echo Form::label('dpi', 'DPI', ['class' => 'control-label requerido', 'id' => 'lb_nombres']); ?>

                                    <?php echo Form::number('cui', '', array_merge(['class' => 'form-control', 'id' => 'cui'])); ?>

                                </div>
                                <div class="col-md-6 ">
                                    <?php echo Form::label('Telefono', 'Telefono', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']); ?>

                                    <?php echo Form::number('telefono', '', array_merge(['class' => 'form-control', 'id' => 'telefono'])); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <?php echo Form::label('email', 'Correo Electronio', ['class' => 'control-label requerido', 'id' => 'lb_nombres']); ?>

                                    <?php echo Form::text('email', '', array_merge(['class' => 'form-control', 'id' => 'email'])); ?>

                                </div>
                                <div class="col-md-6 ">
                                    <?php echo Form::label('lugar_notificacion', 'Lugar para recibir notificacion', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']); ?>

                                    <?php echo Form::text('lugar_notificacion', '', array_merge(['class' => 'form-control', 'id' => 'lugar_notificacion'])); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <?php echo Form::label('id_ci_tipo_solicitud', 'Tipo de Solicitud', ['class' => 'control-label requerido', 'id' => 'lb_tipo_solicitud']); ?>

                                    <?php echo Form::select('id_ci_tipo_solicitud', @$id_ci_tipo_solicitud, '', array_merge(['class' => 'form-control', 'id' => 'id_ci_tipo_solicitud'])); ?>

                                </div>
                            </div>
                            <br>
                            <div id="dynamicDiv" >
                            </div>
                        <br>
                    </form>
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

<?php echo e(Html::style('sources/datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>

<?php echo e(Html::script('sources/datetimepicker/js/moment.js')); ?>

<?php echo e(Html::script('sources/datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>

<?php echo Html::style('sources/font-awesome-4.6.3/css/font-awesome.min.css'); ?>

<?php echo e(Html::style('sources/datepicker/css/bootstrap-datepicker.min.css')); ?>

<?php echo e(Html::script('sources/datepicker/js/bootstrap-datepicker.min.js')); ?>

<?php echo e(Html::script('sources/datepicker/locales/bootstrap-datepicker.es.min.js')); ?>



    <script type="text/javascript">
        document.getElementById('cui').addEventListener('keyup', function(e) {
            var value = $('#cui').val().length;
            if (value > 13)
            {
                document.getElementById('cui').value = " ";
                toastr.error("DPI no puede ser mayor de 13 digitos");
            }
        });

        document.getElementById('telefono').addEventListener('keyup', function(e) {
            var value = $('#telefono').val().length;
            if (value > 8)
            {
                document.getElementById('telefono').value = " ";
                toastr.error("Telefono no puede ser mayor de 8 digitos");
            }
        });

        $("#btnCita").click(function(){
            window.location="<?php echo e(route('solicitudIndex')); ?>";
        });

        $("#id_ci_tipo_solicitud").change(function () {
            if ($('#id_ci_tipo_solicitud').val() == -1) {
                toastr.info('Seleccione un tipo de solicitud');
            }
            else
            {
                var URL ="<?php echo e(route('getForm')); ?>";
                var token = '<?php echo e(csrf_token()); ?>';
                var data = {id_ci_tipo_solicitud:$(this).val()}//$('#form_ingreso').serialize();
                callAjaxBlock(URL,token, data, function (response) {
                    $.unblockUI();
                    if (response.status != 200) {
                        //toastr.error(response.mensaje);
                        return false;
                    }
                    if (response.status === 200) {
                        $("#dynamicDiv").html(response.data.body);
                        //toastr.success(response.mensaje);
                    }
                });
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>