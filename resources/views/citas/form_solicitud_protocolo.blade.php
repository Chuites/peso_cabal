<div style="background: #a8bdf7; padding: 5px;">

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
          <div class="col-md-6" >
                    {!! Form::label('Copia simple', 'Copia simple', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
                    {{ Form::checkbox(null,null,null, array('onClick'=>"Select_Cod(this,'1','new_cadena');")) }}
          </div>
          <div class="col-md-6" >
                    {!! Form::label('Copia simple legalizada', 'Copia simple legalizada', ['class' => 'control-label ', 'id' => 'lb_objeto_contrato']) !!}
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

<div class="row">
          <div class="col-md-12" >
                    {!! Form::label('Observaciones', 'Observaciones', ['class' => 'control-label requerido', 'id' => 'lb_objeto_contrato']) !!}
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
            {!! Form::label('Hora', 'Hora', ['class' => 'control-label requerido', 'id' => 'lb_numero']) !!}
            {!! Form::text('hora_v', '', array_merge(['class' => 'form-control', 'id' => 'hora_v','readonly'])) !!}
    </div>
</div>
<br>
<div class="row">
    <center>
    <a class="btn btn-success btnGenerarSolicitud" id="btnGenerarSolicitud" href="#"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar solicitud</a>
    </center>
</div>



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
                    <div class="form-group">
                        <label for="de:" class="control-label" id="lb-de">Hora:</label>
                        <div class='input-group date' data-align="top">
                            <input type='text' class="form-control " id="hora_modal" name="hora_modal" readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time" ></span>
                            </span>
                        </div>
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
    daysOfWeekHighlighted: [1,2,3,4,5]
});

$('#fecha_modal').datepicker('setStartDate','{{$hoy}}');

$(document).ready(function(){
    $('#hora_modal').datetimepicker({
        format: 'HH:mm',
        disabledTimeIntervals: [
                                    [moment({ h: 00 }), moment({ h: 8 })],
                                    [moment({ h: 12, m:59 }), moment({ h: 14 })],
                                    [moment({ h: 18 }), moment({ h: 24 })]
                                ],
        ignoreReadonly: true,
        showClose: true,
    });
});


$("#btnGenerarSolicitud").click(function(e){
    e.preventDefault();
    var URL = "{{route('generarSolicitud')}}";
    var TOKEN = '{{ csrf_token() }}';
    var DATA = $('#form_consulta').serialize();
    callAjaxBlock(URL, TOKEN, DATA, function(response){
        $.unblockUI();
        if (response.status != 200) {                    
            toastr.error(response.mensaje);
            return false;
        }
        //alert(response.data.id);
        $('#id').val(response.data.id);
        $('#form_view_imp_boleta').attr('action', '{{ route("viewBoletaPDFSolicitud") }}');
        $('#form_view_imp_boleta').submit();
        
       
    })
});

$("#btnAgregar").click(function(e){
    e.preventDefault();
    $("#fecha_v").val($("#fecha_modal").val());
    $("#hora_v").val($("#hora_modal").val());
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



