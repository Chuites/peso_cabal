/* Funciones JavaScript Validacion
   Versión 1
   Autor: Rony Giron
   Fecha: Guatemala 24 de mayo de 2016
*/


/*
    Autor: Rony Giron
    Fecha: Guatemala 24 de mayo de 2016
    Descripcion:se restrige la longuitud de los caracteres
    Parametros:Id del input, y cantidad de los caracteres que se desean restrigir
*/

function LonguitudInput(idInput,length) {
    document.getElementById(idInput).maxLength = length;
}


/*
    Autor: Rony Giron
    Fecha: Guatemala 24 de mayo de 2016
    Descripcion:se restrige la longuitud de los caracteres
    Parametros:Id del input
*/

function aMays(e, elemento) {
    tecla=(document.all) ? e.keyCode : e.which; 
    elemento.value = elemento.value.toUpperCase();
}

function eMin(e, elemento) {
    tecla=(document.all) ? e.keyCode : e.which; 
    elemento.value = elemento.value.toLowerCase();
}

/*
    Autor: Maco
    Fecha: Guatemala 24 de mayo de 2016
    Descripcion:Validaciones sobre el input
    Parametros:Id del input

 */


function validar(e, opt) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla === 8)
        return true; //valida tecla de retroceso
    if (tecla === 0)
        return true; //valida tecla de tabulacion

    switch (opt)
    {
        case 1:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\d\t]/; //Permite letras y numeros        
            }
            break;
        case 2:
            {
                patron = /[\d\t]/; //Permite solo numeros
            }
            break;
        case 3:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\t]/; //Permite solo letras
            }
            break;
        case 4:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\s\t]/; //Permite letras y el espacio en blanco
            }

            break;
        case 5:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\s\d\t\-]/; //Permite letras, numeros y el espacio en blanco
            }
            break;
        case 6:
            {
                //patron = /[-\d\t]/; //Permite solo numeros y guion
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\d\t\-]/; //Permite letras, numeros y guion
            }
            break;
        case 7:
            {
                patron = /[\d\t\.]/; //Permite solo numeros y punto
            }
            break;
        case 8:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\t\.\_]/; //Permite letras, guion bajo y punto
            }
            break;
        case 9:
            {
                patron = /[A-Za-zñÑáéíóúÁÉÍÓÚ\t\.\_\/]/; //Permite letras, guion bajo, diagonal y punto
            }
            break;
        case 10:
            {
                patron = /[A-Za-z\d\t]/; //Permite letras sin tildes y numeros        
            }
            break;
        case 11:
            {
                patron = /[\d\t\s]/; //Permite solo numeros y espacio en blanco      
            }
            break;
        case 13:
            {
                patron = /[A-Za-zñÑ\d\t\s\.\,]/; //Permite letras sin tildes, numeros y espacios y ñ  
            }
            break;          
        default:
        {
            patron = /[\'\?\¡\¿\*\"\~\[\]\{\}\+\$\&\%\#\=\^\<\>\(\)\!]/; //Permite todo menos los caracteres extraños
            te = String.fromCharCode(tecla); // 5
            return !patron.test(te); // 6 
        }
    }

    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6   
};

/**
 * cambia tipo de input de password a texto o viceversa
 * @autor maco
 */
function eye() {
    var passField = $("#password").val();

    if ($('#password').attr('type') == 'password') {        
        $('#password').get(0).type = 'text';
    } else if ($('#password').attr('type') == 'text') {
        $('#password').get(0).type = 'password';
    }
}

/**
 * oculta opcion de ver password en formulario
 * @autor maco 
 */
function ocultar(id) {
    document.getElementById(id).style.display="none";
}
      
/**
 * muestra la opcion de ver password 
 * @autor maco
 */
function mostrar(id){
    ocultar("eye1");
    ocultar("eye2");
    document.getElementById(id).style.display="block";
}

/**
 * Helper callajax 
 * @autor rgiron
 */

function callAjax(url,token,datos, response){
    $.ajax({
        type: "POST",
        url: url,
        dataType : 'json',
        headers: {'X-CSRF-TOKEN': token},
        data: datos,
        success: response,
        error:response           
    });                
}


/**
 * muestra errores required 
 * @autor rgiron
 */

function error(errores){
    var errors = errores;
    if(Object.keys(errores.errors).length > 0)
        errors = errores.errors;
    errorsHtml = '<div><ul>';
    $.each( errors , function( key, value ) {
        errorsHtml += '<li>' + value[0] + '</li>'; 
    });
    errorsHtml += '</ul></div>';
    $('#alerta').delay(1).show(1000);
    $('#alerta').html(errorsHtml).delay(1000).hide(1000); 
}

/**
 *  muestra errores  
 * @autor rgiron
 */

function aviso(mensaje) {
    $('#aviso').delay(1).show(1000);
    $('#aviso').html(mensaje).delay(1000).hide(1000);
}

/**
 *  muestra errores  
 * @autor rgiron
 */

function alerta(mensaje) {
    $('#alerta').delay(1).show(1000);
    $('#alerta').html(mensaje).delay(1000).hide(1000);
}

/**
 *  muestra errores  enviandole su id
 * @autor rgiron
 */

function avisoId(id, mensaje) {  
    if (jQuery.type(mensaje) === 'object') {        
        errorsHtml = '<div><ul>';
        $.each( mensaje , function( key, value ) {
            errorsHtml += '<li>' + value[0] + '</li>'; 
        });
        errorsHtml += '</ul></div>';    
    } else {
        errorsHtml = mensaje;
    }
    
    $('#'+id+'').delay(1).show(1000);
    $('#'+id+'').html(errorsHtml).delay(1000).hide(1000);
}

/**
 *  cierra mensajes success
 * @autor rgiron
 */

function msjSuccess() {
    setTimeout(function() 
    { 
        $( "#clickAlerta" ).trigger( "click" );
    } , 3000);
    
}
msjSuccess();

/**
 * [nobackbutton bloquea boton atras]
 */
function nobackbutton(){
   window.location.hash="";
   window.location.hash="Again-No-back-button"   
   window.onhashchange=function(){window.location.hash="";}
}

/**************************************************INTEGRACION 7-9-2016*****************************************************************************/

function callAjaxBlock(url,token,datos, response,mensaje){
    if (mensaje){
        var mensaje2 = 'Enviando Correo...';
    } else {
        var mensaje2 = 'Cargando...';
    }

    $.blockUI({ 
        message: '<i class="fa fa-cog fa-spin fa-2x fa-fw"></i><span>'+mensaje2+'</span>' ,
        css: { 
            backgroundColor: 'none', 
            color: '#fff',
            border: 'none',
        }
    });
    $.ajax({
        type: "POST",
        url: url,
        dataType : 'json',
        headers: {'X-CSRF-TOKEN': token},
        data: datos,
        success: response,
        error:response           
    });                
}

/**
 * [validarVacion valida que los campos sea requeridos por medio de jquery]
 */
function validarVacio(variable,msj,idDiv) {
    if ($.trim(variable.val()) =='' || $.trim(variable.val())== '-1' ) {
        avisoId(idDiv, msj);
        variable.focus();
        return false;
    }
    return true;
}


/**
 * [pintarGrafica pinta una grafica]
 */
function pintarGrafica(tipo_, titulo_, yAxis_, xAxis_, seriename, seriedata) {
    $('#container').highcharts({
        "chart": {
            "type":tipo_
        },
        "title": {
            "text":titulo_
        },
        "plotOptions": {
            "column":{"pointPadding":0.2,"borderWidth":0}
        },
        "credits": {
            "enabled":false
        },
        "xAxis": {
            "categories":xAxis_
        },
        "yAxis": {
            "title":{"text":yAxis_}
        },
        "series":[{"name":seriename,"data":seriedata}]
    });
}

function marcarErrores(data) {                            
    //var json = '[{"input":"id-tex","mensaje":"Debe ingresar data"}]';
    $.each(JSON.parse(data), function(idx, obj) {        
        $("#"+obj.input).addClass("has-error"); 
        $("#error-"+obj.input).html(obj.mensaje).show();                
    });
}

function quitarMarca(id) {
    $("#inputDiv_"+id).removeClass("has-error");         
    $('#error-'+id).hide();
}

function sweetErrorList(errores, showModal){    
    var errors = errores; 
    errorsHtml = '<ul id="listErrorDiv">';
    $.each( errors , function( key, value ) {        
        errorsHtml += '<li>' + value[0] + '</li>';         
        $("#inputDiv_"+key).addClass("has-error"); 
        $("#error-"+key).html(value[0]).show();
    });
    errorsHtml += '</ul>';
    if (showModal){
        bootbox.dialog({
            message: errorsHtml,
            title: '<i class="fa fa-warning"></i> Problemas Encontrados',
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "btn-success"
                }
            }
        });    
    }    
    
}
function sweetError(mensaje) {    
    bootbox.dialog({
        message: '<p style="color: red;">' + mensaje + '</p>',
        title: '<i class="fa fa-warning"></i> Problemas Encontrados',
        buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success"
            }
        }
    });
}
function sweetSuccess(mensaje) {    
    bootbox.dialog({
        message: '<p style="color: green;">' + mensaje + '</p>',
        title: '<i class="fas fa-check-circle"></i> ¡ÉXITO!',
        buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success"
            }
        }
    });
}


/**
 * [confirmacion helper para confirmación]
 * @param  {[type]} funcionEjecutar [description]
 * @return {[type]}                 [description]
 * autor: Rony Giron
 */
function callConfirmation(mensaje,titulo,funcionEjecutar){
    bootbox.dialog({
      message: mensaje,
      title: titulo,
      buttons: {
        salir: {
          label: '<i class="fa fa-times"></i> Cancelar',
          className: "btn-danger"
        },
        aceptar: {
          label: '<i class="fa fa-check-square-o"></i> Aceptar',
          className: "btn-success",
          callback: function() {
            funcionEjecutar()
          }
        }
      }
    }); 
}

function ajaxDelete(url, id, name='', table='') {
    bootbox.confirm({
        message: '<h4 style="font-weight: bold;">Realmente desea eliminar el registro?</h4><br>' + name,
        buttons: {
            confirm: {
                label: '<i class="fa fa-trash"></i> Eliminar',
                className: 'btn-success'
            },
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                var URL = url;
                var token = $('meta[name="appToken"]').attr('content');
                var data = {id: id}; 

                callAjaxBlock(URL,token, data, function (response) {
                    $.unblockUI();
                    if  (response.status != 200){
                        sweetError(response.mensaje);
                        return false;
                    }

                    sweetSuccess(response.mensaje);

                    if (table != ''){
                        $('#'+table).DataTable().ajax.reload();
                    }
                    
                }); 
            }
        }
    });
}



