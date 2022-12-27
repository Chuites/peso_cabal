@php

/*
 * componente para crear un input basado en bootstrap
 * verifica si son envidados los parametros de lo contrario usa valores default
 * @autor Carlos Corzantes
 */

$name = (isset($name) && $name)? $name : 'input';
$label = (isset($label) && $label)? $label : $name;
$value = (is_null($value) && $value)? null : $value;
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
    {!! Form::text($name, $value, array_merge(['class' => $class, 'id' => $name], $attributes)) !!}    
    <div class="help-block with-errors"></div>
    <span class="errorInputTxt" id="error-{{$name}}"></span>
</div>