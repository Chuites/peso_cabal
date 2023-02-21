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

    <div id="particles-js"></div>
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
