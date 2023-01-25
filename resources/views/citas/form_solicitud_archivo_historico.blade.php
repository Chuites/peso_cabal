<style>
    .text-center { text-align: center; }
    .text-justify { text-align: justify; }
    .text-right { text-align: right; }
    .bold{ font-weight: bold; }
    .col-12 {width: 100%; }
    .col-11 {width: 91.66%; }
    .col-10 {width: 83.33%; }
    .col-9 {width: 75%; }
    .col-8 {width: 66.66%; }
    .col-7 {width: 58.33%; }
    .col-6 {width: 50%; }
    .col-5 {width: 41.66%; }
    .col-4 {width: 33.33%; }
    .col-3 {width: 25%; }
    .col-2 {width: 16.66%; }
    .col-1 {width: 8.33%; }
</style>
<div style="background: #793e3e34; padding: 5px;">
    <hr>
    <h3><strong>Datos de Consulta de Archivo Historico</strong></h3>
    <div class="row">
        <div class="col-md-6">
            {!! Form::label('id_ci_tipo_consulta', 'Tipo de Consulta', ['class' => 'control-label requerido', 'id' => 'lb_tipo_consulta']) !!}
            {!! Form::select('id_ci_tipo_consulta', @$id_ci_tipo_consulta, '', array_merge(['class' => 'form-control', 'id' => 'id_ci_tipo_consulta'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" >
            {!! Form::label('Institucion', 'Institucion', ['class' => 'control-label requerido', 'id' => 'lb_institucion']) !!}
            {!! Form::text('institucion', '', array_merge(['class' => 'form-control', 'id' => 'institucion'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Descripcion', 'Descripcion', ['class' => 'control-label requerido', 'id' => 'lb_descripcion']) !!}
            {!! Form::text('descripcion', '', array_merge(['class' => 'form-control', 'id' => 'descripcion'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" >
            {!! Form::label('Año', 'Año', ['class' => 'control-label requerido', 'id' => 'lb_anio']) !!}
            {!! Form::text('anio', '', array_merge(['class' => 'form-control', 'id' => 'anio'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Signatura', 'Signatura', ['class' => 'control-label requerido', 'id' => 'lb_signatura']) !!}
            {!! Form::text('signatura', '', array_merge(['class' => 'form-control', 'id' => 'signatura'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            {!! Form::label('Observaciones', 'Observaciones', ['class' => 'control-label requerido', 'id' => 'lb_observaciones']) !!}
            {!! Form::textarea('observaciones', '', array_merge(['class' => 'form-control', 'id' => 'observaciones', 'rows'=>'3'])) !!}
        </div>
    </div>
</div>

    <hr>
    <h3><strong>Datos de Cita</strong></h3>

        <center>
            <a class="btn btn-primary opAgengarCitaProtocolo" href="#"><i class="fa fa-calendar "></i>&nbsp;Agendar cita</a>
        </center>
    <div class="row">
        <div class="col-md-6" >
            {!! Form::label('Fecha', 'Fecha', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
            {!! Form::text('fecha_v', '', array_merge(['class' => 'form-control', 'id' => 'fecha_v','readonly'])) !!}

            </div>
        <div class="col-md-6 ">
            {!! Form::label('Hora', 'Hora', ['class' => 'control-label requerido', 'id' => 'lb_hora']) !!}
            {!! Form::text('hora_v', '', array_merge(['class' => 'form-control', 'id' => 'hora_v','readonly'])) !!}
        </div>
    </div>
<br>
<div class="row">
    <center>
        <a class="btn btn-success btnGenerarSolicitud" id="btnGenerarSolicitud" href="#"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar solicitud</a>
    </center>
</div>

{{-- MODAL DE CITA --}}
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalCitaProtocolo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agendar | <small id="modalSubtitle">Cita</small></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label >Fecha</label>
                        <div class="input-group date" data-align="top" >
                            <input type="text" class="form-control"  id="fecha_modal"  readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label >Hora</label>
                        <div class="input-group date" data-align="top" >
                            {!! Form::select('id_horario_cita', @$id_horario_cita, '', array_merge(['class' => 'form-control', 'id' => 'id_horario_cita'])) !!}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer centrado_vertical">
                {{ Form::boton('false', 'cancelar', false, false, false, 'data-dismiss="modal"') }}
                {{ Form::boton('btnAgregar', 'guardar', 'link', false, false, false) }}
            </div>
        </div>
    </div>
</div>

{{-- MODAL DE CONFIRMACION --}}
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalCitaCreada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
            {{-- Se omite el boton de cerrar del modal --}}
            {{--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                <h4 class="modal-title" id="myModalLabel">Cita Creada | <small id="modalSubtitle">Datos</small></h4>
            </div>
            <div class="modal-body">
                <center>
                    <div class="row">
                        <table  width="80%" class="tabla">
                            <tr>
                                <td class="gray tb-td text-center" colspan="2"><strong>DATOS DEL SERVICIO SOLICITADO</strong></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Tipo de Consulta</td>
                                <td class="col-7 tb-td" id="tbl_tipo_consulta"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Institucion</td>
                                <td class="col-7 tb-td" id="tbl_institucion"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Descripcion</td>
                                <td class="col-7 tb-td" id="tbl_descripcion"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Año</td>
                                <td class="col-7 tb-td" id="tbl_anio"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Signatura</td>
                                <td class="col-7 tb-td" id="tbl_signatura"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Observaciones</td>
                                <td class="col-7 tb-td" id="tbl_observaciones"></td>
                            </tr>
                        </table>
                        <br>
                        <table  width="80%" class="tabla">
                            <tr>
                                <td class="gray tb-td text-center" colspan="2"> <strong>DATOS DEL SOLICITANTE</strong> </td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Nombre completo:</td>
                                <td class="col-7 tb-td" id="tbl_nombre_completo"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Número de DPI</td>
                                <td class="col-7 tb-td" id="tbl_cui"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Lugar para recibir notificación</td>
                                <td class="col-7 tb-td" id="tbl_direccion_notificacion"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Teléfono</td>
                                <td class="col-7 tb-td" id="tbl_telefono"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Correo Electrónico</td>
                                <td class="col-7 tb-td" id="tbl_correo_electronico"></td>
                            </tr>
                        </table>
                        <br>
                        <table  width="80%" class="tabla">
                            <tr>
                                <td class="gray col-12 tb-td text-center" colspan="2"><strong>DATOS DE LA CITA</strong></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Fecha de Cita</td>
                                <td class="col-7 tb-td" id="tbl_fecha_cita"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Hora de Cita</td>
                                <td class="col-7 tb-td" id="tbl_hora_cita"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div style="width: 80%">
                        <strong>
                            La cita se ha creado correctamente, se ha generado su boleta de solicitud en formato PDF,
                            descarguela e imprimala como constancia de su tramite.
                        </strong>
                    </div>
                </center>
            </div>
            <div class="modal-footer centrado_vertical">
                {{ Form::boton('btnConfirmar', 'guardar', 'link', 'Confirmar', false, false) }}
            </div>
        </div>
    </div>
</div>

<form id="form_view_imp_boleta" method="post" action="" target='_blank'>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id='token'>
    <input type="hidden" name="id" id="id">
</form>

<script>
    $('#fecha_modal').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
        daysOfWeekDisabled: [0,6],
        daysOfWeekHighlighted: [1,2,3,4,5],
        datesDisabled: @json($disabledDates)
    });
    $('#fecha_modal').datepicker('setStartDate','{{$hoy}}');

    $(document).ready(function(){
        $('#hora_modal').datetimepicker({
            format: "HH:mm",
            disabledTimeIntervals: [
                [moment({ h: 00 , m: 01}), moment({ h: 8, m: 00 })],
                [moment({ h: 12, m:59 }), moment({ h: 14 })],
                [moment({ h: 18 }), moment({ h: 24 })]
            ],
            ignoreReadonly: true,
            showClose: true,
        });
    });

    $("#btnGenerarSolicitud").click(function(e){
        e.preventDefault();

        //Se asignan los valores al modal
        var consulta = document.getElementById("id_ci_tipo_consulta");
        var opcion = consulta.options[consulta.selectedIndex].text;
        $('#tbl_tipo_consulta').text(opcion);

        $('#tbl_institucion').text($('#institucion').val());
        $('#tbl_descripcion').text($('#descripcion').val());
        $('#tbl_anio').text($('#anio').val());
        $('#tbl_signatura').text($('#signatura').val());
        $('#tbl_observaciones').text($('#observaciones').val());

        //Datos del solicitante
        $('#tbl_nombre_completo').text($('#nombres').val()+" "+$('#apellidos').val());
        $('#tbl_telefono').text($('#telefono').val());
        $('#tbl_direccion_notificacion').text($('#lugar_notificacion').val());
        $('#tbl_correo_electronico').text($('#email').val());
        $('#tbl_cui').text($('#cui').val());

        //Datos de la cita
        $('#tbl_fecha_cita').text($('#fecha_v').val());
        $('#tbl_hora_cita').text($('#hora_v').val());

        var URL = "{{route('generarSolicitud')}}";
        var TOKEN = '{{ csrf_token() }}';
        var DATA = $('#form_consulta').serialize();
        //alert (DATA);
        callAjaxBlock(URL, TOKEN, DATA, function(response){
            $.unblockUI();
            if (response.status != 200) {
                toastr.error(response.mensaje);
                return false;
            }
            $('#modalCitaCreada').modal('show');
            $('#form_view_imp_boleta').attr('action', '{{ route("viewBoletaPDFSolicitud") }}');
            $('#form_view_imp_boleta').submit();
        })
    });

    $('#fecha_modal').change(function(){
        $.get("{{ route('horariosDisponibles')}}",
        {
            fecha: $('#fecha_modal').val(),
            id_tipo_solicitud: $('#id_ci_tipo_solicitud').val()
        },
        function(data) {
            $('#id_horario_cita').empty();
            $('#id_horario_cita').append("<option value='' selected='selected'>Seleccionar..</option>")
            $.each(data, function(key, element) {
                $('#id_horario_cita').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });

    //Boton del modal de confirmacion
    $("#btnConfirmar").click(function(e)
    {
        e.preventDefault();
        $('#modalCitaCreada').modal('hide');
        window.location = "/solicitud"
    });

    $("#btnAgregar").click(function(e){
        e.preventDefault();
        $("#fecha_v").val($("#fecha_modal").val());
        var combo = document.getElementById("id_horario_cita");
        var selected = combo.options[combo.selectedIndex].text;
        //alert(selected);
        $("#hora_v").val(selected);
        $('#modalCitaProtocolo').modal('hide');
    });

    $(".opAgengarCitaProtocolo").click(function(e){
        e.preventDefault();
        $('#modalCitaProtocolo').modal('show');
    });

    function Select_Cod(campo,cod_credito,seleccionadas){
        if(document.getElementById(seleccionadas)!= null){
            valor_ant = document.getElementById(seleccionadas).value;
            if(valor_ant != ''){
                if(campo.checked == true){
                    document.getElementById(seleccionadas).value = document.getElementById(seleccionadas).value+","+cod_credito+"";
                }else{
                    var valor_ant = document.getElementById(seleccionadas).value;
                    document.getElementById(seleccionadas).value=document.getElementById(seleccionadas).value.replace(","+cod_credito,"");
                    var valor_post = document.getElementById(seleccionadas).value;
                    if(valor_ant==valor_post){
                        document.getElementById(seleccionadas).value=document.getElementById(seleccionadas).value.replace(cod_credito+",","");
                        valor_post = document.getElementById(seleccionadas).value;
                        if(valor_ant==valor_post){
                            document.getElementById(seleccionadas).value=document.getElementById(seleccionadas).value.replace(cod_credito,"");
                        }
                    }
                }
            }else{ document.getElementById(seleccionadas).value = cod_credito; }
        } else{ alert('No Existe');}
    }
</script>



