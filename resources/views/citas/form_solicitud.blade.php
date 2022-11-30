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
                    <h3>Agendar Cita</h3>
                    <br>
                    <h3>DATOS SOLICITANTE</h3>
                    <br>
                    <form id="form_consulta">
                         <div class="row">
                              <div class="col-md-6" >
                                        {!! Form::label('Nombres', 'Nombres', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
                                        {!! Form::text('nombres', '', array_merge(['class' => 'form-control', 'id' => 'nombres'])) !!}
                              </div>
                              <div class="col-md-6 ">
                                        {!! Form::label('Apellidos', 'Apellidos', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']) !!}
                                        {!! Form::text('apellidos', '', array_merge(['class' => 'form-control', 'id' => 'apellidos'])) !!}
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6" >
                                        {!! Form::label('dpi', 'DPI', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
                                        {!! Form::text('dpi', '', array_merge(['class' => 'form-control', 'id' => 'dpi'])) !!}
                              </div>
                              <div class="col-md-6 ">
                                        {!! Form::label('Telefono', 'Telefono', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']) !!}
                                        {!! Form::text('telefono', '', array_merge(['class' => 'form-control', 'id' => 'telefono'])) !!}
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6" >
                                        {!! Form::label('dpi', 'Correo Electronio', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
                                        {!! Form::text('dpi', '', array_merge(['class' => 'form-control', 'id' => 'dpi'])) !!}
                              </div>
                              <div class="col-md-6 ">
                                        {!! Form::label('notificacion', 'Lugar para recibir notificacion', ['class' => 'control-label requerido', 'id' => 'lb_apellidos']) !!}
                                        {!! Form::text('telefono', '', array_merge(['class' => 'form-control', 'id' => 'telefono'])) !!}
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6" >
                                        {!! Form::label('id_ci_tipo_solicitud', 'Tipo de Solicitud', ['class' => 'control-label requerido', 'id' => 'lb_tipo_solicitud']) !!}
                                        {!! Form::select('id_ci_tipo_solicitud', @$id_ci_tipo_solicitud, '', array_merge(['class' => 'form-control', 'id' => 'id_ci_tipo_solicitud'])) !!} 
                              </div>
                              <div class="col-md-6 ">
                                        
                              </div>
                         </div>

                         
  
                        <br>
                    </form>
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

        $("#btnCita").click(function(){
          window.location="{{route('solicitudIndex')}}";
        });

    </script>
@endsection
