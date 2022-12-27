@php

/*
 * componente para crear un input fecha basado en bootstrap
 * verifica si son envidados los parametros de lo contrario usa valores default
 * @autor Marco Prado
 */

$name = (isset($name) && $name)? $name : 'date';
$label = (isset($label) && $label)? $label : $name;
$value = (isset($value) && $value)? $value : null;
$class = (isset($class) && $class)? $class : 'form-control';
$attributes = (isset($attributes) && $attributes)? $attributes : array();
$isRequired = (isset($isRequired) && $isRequired)? true : false;

//campo que muestra que es requerido
if ($isRequired) {
    $txtRequired = 'requerido';  
} else {
    $txtRequired = '';    
}

@endphp
<div class="form-group" id="inputDiv_{{$name}}">
    {!! Form::label($label, $label, ['class' => 'control-label '.$txtRequired, 'id' => 'lb_'.$name]) !!}    
    {!! Form::date($name, $value, array_merge(['class' => $class, 'id' => $name], $attributes)) !!}
    <div class="help-block with-errors"></div>
    <span class="errorInputTxt" id="error-{{$name}}"></span>
</div>
