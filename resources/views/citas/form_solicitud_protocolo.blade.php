{{ Html::style('sources/DataTables-1.10.12/css/jquery.dataTables.css') }}
{{ Html::script('sources/DataTables-1.10.12/js/jquery.dataTables.js') }}
{{ Html::script('sources/DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}
{{ Html::script('js/toastr.js') }}
{{ Html::style('css/toastr.css') }}
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
<div style="background: #5a6f9c9c; padding: 5px;">

<hr>
<h3><strong>Datos de Instrumento Público</strong></h3>
<div class="row">
        <div class="col-md-6" >
                {!! Form::label('Fecha', 'Fecha', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
                {!! Form::date('fecha_solicitud', '', array_merge(['class' => 'form-control', 'id' => 'fecha_solicitud'])) !!}
        </div>
        <div class="col-md-6 ">
                {!! Form::label('Número', 'Número', ['class' => 'control-label requerido', 'id' => 'lb_numero']) !!}
                {!! Form::text('numero', '', array_merge(['class' => 'form-control', 'id' => 'numero'])) !!}
        </div>
</div>
<div class="row">
        <div class="col-md-12" >
                {!! Form::label('Escribano o Camara de Gobierno', 'Escribano o Camara de Gobierno', ['class' => 'control-label requerido', 'id' => 'lb_escribano']) !!}
                {!! Form::text('escribana_camara', '', array_merge(['class' => 'form-control', 'id' => 'escribana_camara'])) !!}
        </div>
</div>
<div class="row">
        <div class="col-md-12" >
                {!! Form::label('Objeto del contrato', 'Objeto del contrato', ['class' => 'control-label requerido', 'id' => 'lb_objeto_contrato']) !!}
                {!! Form::textarea('objeto_contrato', '', array_merge(['class' => 'form-control', 'id' => 'objeto_contrato', 'rows'=>'3'])) !!}
        </div>
</div>

{!! Form::label('Seleccione los documentos a solictar:', 'Seleccione los documentos a solictar:', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
<div class="row">
    {{-- <div class="form-check col-md-6">
        <input class="form-check-input" type="checkbox" value="copia_simple" id="copia_simple" onClick= "Select_Cod(this,'1','new_cadena')">
        <label class="lb_copia_simple" for="copia_simple">Copia Simple</label>
    </div>
    <div class="form-check col-md-6">
        <input class="form-check-input" type="checkbox" value="copia_legalizada" id="copia_legalizada" onClick= "Select_Cod(this,'2','new_cadena')">
        <label class="lb_copia_legalizada" for="copia_legalizada">Copia Simple Legalizada</label>
    </div> --}}
    <div class="col-md-6" >
            {!! Form::label('Copia simple', 'Copia simple', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
            {{ Form::checkbox(null,null,null, array('onClick'=>"Select_Cod(this,'1','new_cadena');")) }}
    </div>
    <div class="col-md-6" >
            {!! Form::label('Copia simple legalizada', 'Copia simple legalizada', ['class' => 'control-label']) !!}
            {{ Form::checkbox(null,null,null, array('onClick'=>"Select_Cod(this,'2','new_cadena');")) }}
    </div>
</div>
<div class="row">
    <div class="col-md-6" >
            {!! Form::label('Testimonio', 'Testimonio', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
            {{ Form::checkbox(null,null,null, array('onClick'=>"Select_Cod(this,'3','new_cadena');")) }}
    </div>
    <div class="col-md-6" >
            {!! Form::label('Testimonio con duplicado', 'Testimonio con duplicado', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
            {{ Form::checkbox(null,null,null, array('onClick'=>"Select_Cod(this,'4','new_cadena');")) }}
    </div>
    <input type="hidden" name="new_cadena"  id="new_cadena">
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
        {!! Form::label('Hora', 'Hora', ['class' => 'control-label requerido', 'id' => 'lb_numero']) !!}
        {!! Form::text('hora_v', '', array_merge(['class' => 'form-control', 'id' => 'hora_v','readonly'])) !!}
    </div>
</div>
<br>
<div class="row">
    <center>
    <a class="btn btn-success btnGenerarSolicitud" id="btnGenerarSolicitud" href="#"><i class="fa fa-save"></i>&nbsp;Generar solicitud</a>
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
                <div class="pull-right">
                    <a id="btnCerrar" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btnAgregar" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp;Guardar</a>
                </div>
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
                                <td class="gray col-5 tb-td" >Fecha</td>
                                <td class="col-7 tb-td" id="tbl_fecha"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Numero</td>
                                <td class="col-7 tb-td" id="tbl_numero"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Escribano de Cámara y de Gobierno</td>
                                <td class="col-7 tb-td" id="tbl_escribano"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Objeto del contrato</td>
                                <td class="col-7 tb-td" id="tbl_objeto_contrato"></td>
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
                                <td class="gray col-12 tb-td text-center" colspan="2"><strong>DOCUMENTOS SOLICITADOS</strong></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Copia Simple</td>
                                <td class="col-7 tb-td" id="tbl_copia"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Copia simple legalizada</td>
                                <td class="col-7 tb-td" id="tbl_copia_legalizada"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Testimonio</td>
                                <td class="col-7 tb-td" id="tbl_testimonio"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Testimonio con Duplicado</td>
                                <td class="col-7 tb-td" id="tbl_testimonio_duplicado"></td>
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
    //Parametros para omitir fin de semana
    $('#fecha_modal').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
        daysOfWeekDisabled: [0,6],
        daysOfWeekHighlighted: [1,2,3,4,5],
        datesDisabled: @json($disabledDates)
    });

    //Fecha inicial día corriente
    $('#fecha_modal').datepicker('setStartDate','{{$hoy}}');

    //Guarda la solicitud
    $("#btnGenerarSolicitud").click(function(e){
        e.preventDefault();

        //Se asignan los valores al modal
        $('#tbl_numero').text($('#numero').val());
        $('#tbl_fecha').text($('#fecha_solicitud').val());
        $('#tbl_escribano').text($('#escribana_camara').val());
        $('#tbl_objeto_contrato').text($('#objeto_contrato').val());

        $('#tbl_nombre_completo').text($('#nombres').val()+" "+$('#apellidos').val());
        $('#tbl_telefono').text($('#telefono').val());
        $('#tbl_direccion_notificacion').text($('#lugar_notificacion').val());
        $('#tbl_correo_electronico').text($('#email').val());
        $('#tbl_cui').text($('#cui').val());

        $('#tbl_fecha_cita').text($('#fecha_v').val());
        $('#tbl_hora_cita').text($('#hora_v').val());

        //Documentos Solicitados
        if(($("#new_cadena").val()).includes('1')){
            $('#tbl_copia').text('Sí');
        }else{$('#tbl_copia').text('No');}
        if(($("#new_cadena").val()).includes('2')){
            $('#tbl_copia_legalizada').text('Sí');
        }else{$('#tbl_copia_legalizada').text('No');}
        if(($("#new_cadena").val()).includes('3')){
            $('#tbl_testimonio').text('Sí');
        }else{$('#tbl_testimonio').text('No');}
        if(($("#new_cadena").val()).includes('4')){
            $('#tbl_testimonio_duplicado').text('Sí');
        }else{$('#tbl_testimonio_duplicado').text('No');}

        var URL = "{{route('generarSolicitud')}}";
        var TOKEN = '{{ csrf_token() }}';
        var DATA = $('#form_consulta').serialize();
        callAjaxBlock(URL, TOKEN, DATA, function(response){
            $.unblockUI();
            if (response.status != 200)
            {
                toastr.error(response.mensaje);
                return false;
            }
            $('#modalCitaCreada').modal('show');
            $('#id').val(response.data.id);
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

    //Boton del modal de Cita
    $("#btnAgregar").click(function(e)
    {
        e.preventDefault();
        $("#fecha_v").val($("#fecha_modal").val());
        var combo = document.getElementById("id_horario_cita");
        var selected = combo.options[combo.selectedIndex].text;
        $("#hora_v").val(selected);
        $('#modalCitaProtocolo').modal('hide');
        //alert($("#new_cadena").val());
    });

    //Boton del modal de confirmacion
    $("#btnConfirmar").click(function(e)
    {
        e.preventDefault();
        $('#modalCitaCreada').modal('hide');
        window.location = "/solicitud"
    });

    $("#btnCerrar").click(function(e)
    {
        e.preventDefault();
        $('#modalCitaProtocolo').modal('hide');
    });

    //Modal de Fecha y Horario de la Cita
    $(".opAgengarCitaProtocolo").click(function(e){
        e.preventDefault();
        $('#modalCitaProtocolo').modal('show');
    });

    //Funcion para verificar documentos solicitados
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
            }else{
                document.getElementById(seleccionadas).value = cod_credito;

            }
        }
        else
        {
            alert('No Existe');
        }
    }
</script>



