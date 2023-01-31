@php

/*
 * componente para crear un select basado en bootstrap
 * verifica si son envidados los parametros de lo contrario usa valores default
 * @autor Carlos Corzantes
 */

$name = (isset($name) && $name)? $name : 'input';
$label = (isset($label) && $label)? $label : $name;
$value = (isset($value) && $value)? $value : null;
$class = (isset($class) && $class)? $class : 'form-control';
$attributes = (isset($attributes) && $attributes && is_array($attributes))? $attributes : array();
$noText = (isset($noText) && $noText)? true : false;
$isRequired = (isset($isRequired) && $isRequired)? true : false;

if(is_object($options)) {
    $newOptions = array();
    foreach ($options as $key => $val) {
        $newOptions[$key] = $val;
    }

    $options = $newOptions;

} else if (is_array($options)) {
    $options = $options;
} else {
    $options = array();
}


$optionTags = array();

if (isset($placeholder) && $placeholder) {    
    $optionTags = array('-1' => $placeholder) + $optionTags;    
} else {
    $optionTags = array('-1' => trans('formhelper.selectOption')) + $optionTags;
}
    
if (isset($show_all) && $show_all) {    
    $optionTags = array('all' => trans('formhelper.selectAll')) + $optionsTags;     
} 
//oculta las opciones extras del select
if ($noText) {
    $optionTags = $options;  
} else {
    $optionTags = $optionTags + $options;      
}

//campo que muestra que es requerido
if ($isRequired) {
    $txtRequired = 'requerido';  
} else {
    $txtRequired = '';    
}

@endphp

<div class="form-group" id="inputDiv_{{$name}}">
    {!! Form::label($label, $label, ['class' => 'control-label '.$txtRequired, 'id' => 'lb_'.$name]) !!}
    {!! Form::select($name, $optionTags, $value, array_merge(['class' => $class, 'id' => $name], $attributes)) !!}
    <div class="help-block with-errors"></div>    
    <span class="errorInputTxt" id="error-{{$name}}"></span>
</div>    
