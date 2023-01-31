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
                    <div class="row " align="center" style="padding: 10px;">
                        <img src="<?php echo e(asset('img/min_gob.png')); ?>" width="500" height="200"><br><br>
                        <h1>Citas en Línea</h><br><br>
                        <button class="btn btn-success" id="btnCita" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agendar cita</button>
                    </div>
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

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>