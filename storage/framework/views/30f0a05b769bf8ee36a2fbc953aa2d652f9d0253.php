<?php 

/*
 * componente para crear un input basado en bootstrap
 * verifica si son envidados los parametros de lo contrario usa valores default
 * @autor Carlos Corzantes
 */

$class = 'btn btn-default';
$icon = 'far fa-circle';
$text = 'Boton';

if (isset($opcion)) {
    switch ($opcion) {
        //clase success
        case 'guardar':
            $class = 'btn btn-success';
            $icon = 'fas fa-save';
            $text = 'Guardar';
        break;
        case 'agregar':
            $class = 'btn btn-success';
            $icon = 'fas fa-plus';
            $text = 'Agregar';
        break;
        case 'asignar':
            $class = 'btn btn-success';
            $icon = 'far fa-check-square';
            $text = 'Asignar';
        break;
        //clase warning
        case 'modificar':
            $class = 'btn btn-warning';
            $icon = 'fas fa-edit';
            $text = 'Modificar';
        break;
        case 'actualizar':
            $class = 'btn btn-warning';
            $icon = 'fas fa-sync';
            $text = 'Actualizar';
        break;
        //clase default
        case 'imprimir':
            $class = 'btn btn-default';
            $icon = 'fas fa-print';
            $text = 'Imprimir';
        break;
        case 'limpiar':
            $class = 'btn btn-default';
            $icon = 'fas fa-eraser';
            $text = 'Limpiar';
        break;
        case 'ordenar':
            $class = 'btn btn-default';
            $icon = 'fas fa-sort';
            $text = 'Ordenar';
        break;
        case 'siguiente':
            $class = 'btn btn-default';
            $icon = 'fas fa-chevron-circle-right';
            $text = 'Siguiente';
        break;
        case 'anterior':
            $class = 'btn btn-default';
            $icon = 'fas fa-chevron-circle-left';
            $text = 'Anterior';
        break;
        //clase danger
        case 'eliminar':
            $class = 'btn btn-danger';
            $icon = 'fas fa-trash';
            $text = 'Eliminar';
        break;
        case 'cancelar':
            $class = 'btn btn-danger';
            $icon = 'fas fa-times';
            $text = 'Cancelar';
        break;
        case 'anular':
            $class = 'btn btn-danger';
            $icon = 'fas fa-times-circle';
            $text = 'Anular';
        break;
        //clase info
        case 'detalle':
            $class = 'btn btn-info';
            $icon = 'far fa-file-alt';
            $text = 'Detalle';
        break;
        case 'info':
            $class = 'btn btn-info';
            $icon = 'fas fa-info-circle';
            $text = 'Información';
        break;
        //clase primary
        case 'descargar':
            $class = 'btn btn-primary';
            $icon = 'fas fa-cloud-download-alt';
            $text = 'Descargar';
        break;
        case 'cargar':
            $class = 'btn btn-primary';
            $icon = 'fas fa-cloud-upload-alt';
            $text = 'Cargar';
        break;
        case 'adjuntar':
            $class = 'btn btn-primary';
            $icon = 'fas fa-paperclip';
            $text = 'Adjuntar';
        break; 
        case 'excel':
            $class = 'btn btn-success';
            $icon = 'far fa-file-excel';
            $text = 'Generar Excel';
        break;
        case 'buscar':
            $class = 'btn btn-primary';
            $icon = 'fa fa-search-plus';
            $text = 'Buscar';
        break;
    }
}

$idRandom = 'no-' . rand(1,100);
$id = (isset($id) && $id)? $id : $idRandom;
$texto = (isset($texto) && $texto)? $texto : $text;
$otros = (isset($otros) && $otros)? $otros : '';
$clasePersonal = (isset($clase) && $clase)? $clase : '';
$href = (isset($url) && $url)? $url : '#';
$class = $class . ' ' . $clasePersonal;


if (isset($tag)){    
    switch ($tag){
        case 'link':
            $html = '<a class="' . $class . '" href="' . $href . '" id="' . $id . '" ' . $otros . '><i class="' . $icon . '"></i>  ' . $texto . '</a>';
        break;
        case 'btn':
            $html = '<button class="' . $class . '" id="'. $id . '" ' . $otros . '><i class="'. $icon . '"></i> ' . $texto . '</button>';
        break;
        case 'icon':
            $html = '<a href="' . $href . '" id="' . $id . '" data-toggle="tooltip" title="'. $texto . '"><i class="' . $icon . ' ' . $clasePersonal . '"></i> </a>';
        break;
        default:
            $html = '<button class="' . $class . '" id="'. $id . '" ' . $otros . '><i class="'. $icon . '"></i> ' . $texto . '</button>';
        break;
    }
    
} else {
    $html = '<button class="' . $class . '" id="'. $id . '" ' . $otros . '><i class="'. $icon . '"></i> ' . $texto . '</button>';    
}

?>

<?php echo $html; ?>    
