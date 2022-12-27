@php

/*
 * componente para crear un input basado en bootstrap de tipo hidden
 * verifica si son envidados los parametros de lo contrario usa valores default
 * @autor Carlos Corzantes
 */

$name = (isset($name) && $name)? $name : 'input';
$value = (isset($value) && $value)? $value : null;
$attributes = (isset($attributes) && $attributes)? $attributes : array();

@endphp

{!! Form::hidden($name, $value, array_merge(['id' => $name], $attributes)) !!}
