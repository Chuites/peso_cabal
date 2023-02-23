<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>CITAS ESCRIBANIA</title>

    <!-- Fonts -->
    <!-- Font Awesome -->
        {!!Html::style('sources/font-awesome-4.6.3/css/font-awesome.min.css')!!}


    <!-- Styles -->
    <!-- Bootstrap -->
        {!!Html::style('sources/bootstrap-3.3.6/css/bootstrap.min.css')!!}
        {!!Html::script('js/mingobapp.js')!!}

    <style>
        body {
            font-family: 'Lato';
            background: url( {{ asset('img/background_migracion.png') }}) #E5E5E5 ;

        }

        .fa-btn {
            margin-right: 6px;
        }



    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="background: linear-gradient(to bottom right, #91c9fa, #659dc9);">
        <div class="container">
            <div class="navbar-header" style="height: 80px; width: 100%;">



                <!-- Branding Image -->
                <a class="navbar-brand float-left" href="{{ url('/') }}">
                    <img src="{{ asset('img/min_gob.png') }}" width="170" height="60">
                </a>
                <div class="pull-right" >
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/logo_sistema.png') }}" width="100" height="60">
                        </a>

                        <a class="navbar-brand pull-right" href="{{ url('/') }}" style="color: #013759; padding-top: 12%;">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <strong>ESCRIBANÍA</strong>
                        </a>
                </div>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <!--<li><a href="{{ url('/home') }}">Inicio</a></li>-->
                </ul>

                <!-- Right Side Of Navbar -->

            </div>
        </div>
    </nav>

    @yield('content')

    <!-- jQuery -->
        {!! Html::script('js/jquery-1.12.4.min.js') !!}

    <!-- Bootstrap -->
        {!!Html::script('sources/bootstrap-3.3.6/js/bootstrap.min.js')!!}
        <!-- BlockUI-->
        {{ Html::script('js/jquery.blockUI.js') }}
         <!-- bootbox-->
        {!!Html::script('js/bootbox.min.js')!!}

    @yield('javascript')
    <script type="text/javascript">
    </script>
</body>
</html>
