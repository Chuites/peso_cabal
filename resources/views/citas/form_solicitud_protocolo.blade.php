<hr>
<h3>Datos de Instrumento Público</h3>
<div class="row">
          
          <div class="col-md-6" >
                    {!! Form::label('Fecha', 'Fecha', ['class' => 'control-label requerido', 'id' => 'lb_nombres']) !!}
                    {!! Form::date('fecha', '', array_merge(['class' => 'form-control', 'id' => 'fecha'])) !!}
          </div>
          <div class="col-md-6 ">
                    {!! Form::label('Número', 'Número', ['class' => 'control-label requerido', 'id' => 'lb_numero']) !!}
                    {!! Form::text('numero', '', array_merge(['class' => 'form-control', 'id' => 'numero'])) !!}
          </div>
</div>
<div class="row">
          <div class="col-md-12" >
                    {!! Form::label('Escribano o Camara de Gobierno', 'Escribano o Camara de Gobierno', ['class' => 'control-label requerido', 'id' => 'lb_escribano']) !!}
                    {!! Form::text('escribano_o_camara', '', array_merge(['class' => 'form-control', 'id' => 'escribano_o_camara'])) !!}
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


   


<script>
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



