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
<div style="background: #aaaaaa; padding: 5px;">

    <hr>
    <h3><strong>Datos de Consulta de Seccion de Tierras</strong></h3>
    <div class="row">
            <div class="col-md-12 ">
                    {!! Form::label('Expediente', 'Expediente', ['class' => 'control-label requerido', 'id' => 'lb_expediente']) !!}
                    {!! Form::text('expediente', '', array_merge(['class' => 'form-control', 'id' => 'expediente'])) !!}
            </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::label('Ingeniero Medidor', 'Ingeniero Medidor', ['class' => 'control-label requerido', 'id' => 'lb_ing_medidor']) !!}
            {!! Form::text('ing_medidor', '', array_merge(['class' => 'form-control', 'id' => 'ing_medidor'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Ingeniero Revisor', 'Ingeniero Revisor', ['class' => 'control-label requerido', 'id' => 'lb_ing_revisor']) !!}
            {!! Form::text('ing_revisor', '', array_merge(['class' => 'form-control', 'id' => 'ing_revisor'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::label('Finca Numero', 'Finca Numero', ['class' => 'control-label requerido', 'id' => 'lb_finca_numero']) !!}
            {!! Form::text('finca_numero', '', array_merge(['class' => 'form-control', 'id' => 'finca_numero'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Diligencia Administrativa', 'Diligencia Administrativa', ['class' => 'control-label requerido', 'id' => 'lb_diligencia_administrativa']) !!}
            {!! Form::text('diligencia_administrativa', '', array_merge(['class' => 'form-control', 'id' => 'diligencia_administrativa'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::label('Opositor', 'Opositor', ['class' => 'control-label requerido', 'id' => 'lb_opositor']) !!}
            {!! Form::text('opositor', '', array_merge(['class' => 'form-control', 'id' => 'opositor'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Terreno Denominado', 'Terreno Denominado', ['class' => 'control-label requerido', 'id' => 'lb_terreno_denominado']) !!}
            {!! Form::text('terreno_denominado', '', array_merge(['class' => 'form-control', 'id' => 'terreno_denominado'])) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            {!! Form::label('Jurisdiccion', 'Jurisdiccion', ['class' => 'control-label requerido', 'id' => 'lb_jurisdiccion']) !!}
            {!! Form::text('jurisdiccion', '', array_merge(['class' => 'form-control', 'id' => 'jurisdiccion'])) !!}
        </div>
        <div class="col-md-6 ">
            {!! Form::label('Departamento', 'Departamento', ['class' => 'control-label requerido', 'id' => 'lb_departamento']) !!}
            {!! Form::text('departamento', '', array_merge(['class' => 'form-control', 'id' => 'departamento'])) !!}
        </div>
    </div>
    <br>

</div>

<hr>
<h3><strong>Datos de Cita</strong></h3>


    <center>
            <a class="btn btn-primary opAgengarCitaProtocolo" href="#"><i class="fa fa-calendar "></i>Agendar cita</a>
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
    <a class="btn btn-success btnGenerarSolicitud" id="btnGenerarSolicitud" href="#"><i class="fa fa-file-pdf-o"></i>Generar solicitud</a>
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
                                <td class="gray col-5 tb-td" >Expediente No.</td>
                                <td class="col-7 tb-td" id="tbl_expediente"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Ingeniero Medidor</td>
                                <td class="col-7 tb-td" id="tbl_ingeniero_medidor"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Ingeniero Revisor</td>
                                <td class="col-7 tb-td" id="tbl_ingeniero_revisor"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Finca Numero</td>
                                <td class="col-7 tb-td" id="tbl_finca_numero"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Diligencia Administrativa</td>
                                <td class="col-7 tb-td" id="tbl_diligencia_administrativa"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Opositor</td>
                                <td class="col-7 tb-td" id="tbl_opositor"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Terreno Denominado</td>
                                <td class="col-7 tb-td" id="tbl_terreno_denominado"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Jurisdiccion</td>
                                <td class="col-7 tb-td" id="tbl_jurisdiccion"></td>
                            </tr>
                            <tr>
                                <td class="gray col-5 tb-td" >Departamento</td>
                                <td class="col-7 tb-td" id="tbl_departamento"></td>
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
                &nbsp;
                <a href="#" id="btnConfirmar" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Aceptar</a>
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

    $("#btnGenerarSolicitud").click(function(e){
        e.preventDefault();

        //Se asignan los valores de la solicitud al modal
        $('#tbl_expediente').text($('#expediente').val());
        $('#tbl_ingeniero_medidor').text($('#ing_medidor').val());
        $('#tbl_ingeniero_revisor').text($('#ing_revisor').val());
        $('#tbl_finca_numero').text($('#finca_numero').val());
        $('#tbl_diligencia_administrativa').text($('#diligencia_administrativa').val());
        $('#tbl_opositor').text($('#opositor').val());
        $('#tbl_terreno_denominado').text($('#terreno_denominado').val());
        $('#tbl_jurisdiccion').text($('#jurisdiccion').val());
        $('#tbl_departamento').text($('#departamento').val());

        //Datos del solicitante
        $('#tbl_nombre_completo').text($('#nombres').val()+" "+$('#apellidos').val());
        $('#tbl_telefono').text($('#telefono').val());
        $('#tbl_direccion_notificacion').text($('#lugar_notificacion').val());
        $('#tbl_correo_electronico').text($('#email').val());
        $('#tbl_cui').text($('#cui').val());

        //Datos de cita
        $('#tbl_fecha_cita').text($('#fecha_v').val());
        $('#tbl_hora_cita').text($('#hora_v').val());

        var URL = "{{route('generarSolicitud')}}";
        var TOKEN = '{{ csrf_token() }}';
        var DATA = $('#form_consulta').serialize();
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
        window.location = "{{route('solicitudIndex')}}"
    });

    $("#btnCerrar").click(function(e)
    {
        e.preventDefault();
        $('#modalCitaProtocolo').modal('hide');
    });

    $("#btnAgregar").click(function(e){
            e.preventDefault();
            $("#fecha_v").val($("#fecha_modal").val());
            var combo = document.getElementById("id_horario_cita");
            var selected = combo.options[combo.selectedIndex].text;
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
            }else{
                document.getElementById(seleccionadas).value = cod_credito;

            }
        }else{
        alert('No Existe');
        }
    }
</script>



