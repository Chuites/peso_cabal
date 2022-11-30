@extends('layouts.app')

@section('content')
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
                        <img src="{{ asset('img/min_gob.png') }}" width="500" height="200"><br><br>
                        <h1>Citas en Línea</h><br><br>
                        <button class="btn btn-success" id="btnConsulta" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agendar cita</button>
                    </div>
                </div>
            </div>
      
    </div>
</div>

<div class="container resultados" style="hide">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style= " background: #00AAE4; color: #fff;}}) #E5E5E5 ; color: #fff;">
                    <!--Ingresar al portal-->
                    <strong>Resultados</strong>
                </div>
                <div class="panel-body">
                    <div class="resultadosTable"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{{ Html::style('sources/DataTables-1.10.12/css/jquery.dataTables.css') }}
{{ Html::script('sources/DataTables-1.10.12/js/jquery.dataTables.js') }}
{{ Html::script('sources/DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}
{{ Html::script('js/toastr.js') }}
{{ Html::style('css/toastr.css') }}
    <script type="text/javascript">
        $(".resultados").hide();
        $("#btnConsulta").click(function(){
            var URL = "{{route('viewEntidades')}}";
            var TOKEN = '{{ csrf_token() }}';
            var DATA = $('#form_consulta').serialize();
            callAjaxBlock(URL, TOKEN, DATA, function(response){
                $.unblockUI();
                if (response.status != 200) {                    
                    toastr.error(response.mensaje);
                    return false;
                }
                grecaptcha.reset();
                $(".resultadosTable").html(response.tabla);
                $(".resultados").show();
            })   
        });
        $("#btnLimpiar").click(function(){
            grecaptcha.reset();
            $(".resultados").hide();
            $("#entidad").val('');
        });
    </script>
@endsection
