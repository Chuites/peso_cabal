<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="http://logos.mingob.gob.gt/icono_mingob.png" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>CITAS ESCRIBANIA</title>

    <!-- Fonts -->
    <!-- Font Awesome -->
        <?php echo Html::style('sources/font-awesome-4.6.3/css/font-awesome.min.css'); ?>



    <!-- Styles -->
    <!-- Bootstrap -->
        <?php echo Html::style('sources/bootstrap-3.3.6/css/bootstrap.min.css'); ?>

        <?php echo Html::script('js/mingobapp.js'); ?>


    <style>
        body {
            font-family: 'Lato';
            background: url( <?php echo e(asset('img/background_migracion.png')); ?>) #E5E5E5 ;

        }

        .fa-btn {
            margin-right: 6px;
        }



    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" >
        <div class="container">
            <div class="navbar-header" style="height: 80px; width: 100%;">



                <!-- Branding Image -->
                <a class="navbar-brand float-left" href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('img/min_gob.png')); ?>" width="170" height="60">
                </a>
                <div class="pull-right" >
                         <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset('img/logo_sistema.png')); ?>" width="100" height="60">
                        </a>


                        <a class="navbar-brand pull-right" href="<?php echo e(url('/')); ?>">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <strong>ESCRIBANÍA</strong>
                        </a>
                </div>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <!--<li><a href="<?php echo e(url('/home')); ?>">Inicio</a></li>-->
                </ul>

                <!-- Right Side Of Navbar -->

            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- jQuery -->
        <?php echo Html::script('js/jquery-1.12.4.min.js'); ?>


    <!-- Bootstrap -->
        <?php echo Html::script('sources/bootstrap-3.3.6/js/bootstrap.min.js'); ?>

        <!-- BlockUI-->
        <?php echo e(Html::script('js/jquery.blockUI.js')); ?>

         <!-- bootbox-->
        <?php echo Html::script('js/bootbox.min.js'); ?>


    <?php echo $__env->yieldContent('javascript'); ?>
    <script type="text/javascript">
    </script>
</body>
</html>
