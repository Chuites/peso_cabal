<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta</title>
</head>
<body style="font-size: 10pt;   font-family: 'Arial, Helvetica, Verdana, Tahoma, sans-serif'">
<header>
<br>
    <table width="100%">
            <tr>
                <td>
                    MINISTERIO DE GOBERNACION<br>
                    ESCRIBANIA CAMARA DE GOBIERNO
                </td>
                <td></td>
                <td align="right">
                    <?php
                    $image_path = '/img/min_gob.png';
                    ?>
                    <img src="{{ public_path() . $image_path }}" width="250" height="80">
                </td>
            </tr>
    </table>



</header>

<!--footer para cada pagina-->
<footer>
    <hr>
    <center>
        <strong>Ministerio de Gobernación 6ta. Avenidad</strong><br>
        <strong>13-71 Zona 1, Sotano PBX 2413-8888</strong><br>
        <strong>Ext. 1901, 5830 </strong><br>
    </center>
</footer>
<div id="content">
    <center><strong>SOLICITUD DE INSTRUMENTO PÚBLICO AUTORIZADO ANTE LA <br>ESCRIBANÍA DE CÁMARA DE GOBIERNO</strong></center>

<style>
.tabla {
    border: 1px solid black; border-collapse: collapse; padding: 1px;

}
.tb-td{
    border: 1px solid black; border-collapse: collapse; padding: 1px;
}
.text-center { text-align: center; }
.text-justify { text-align: justify; }
.text-right { text-align: right; }
.gray{ background-color: #ddd; font-weight: bold;}
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
<br>
<table  width="100%" class="tabla">
    <tr>
        <td class="gray tb-td text-center" colspan="2">DATOS DEL SERVICIO SOLICITADO</td>
    </tr>
    <tr>
        <td class="gray tb-td" colspan="2">&nbsp;GUATEMALA {{@$dia}}     DE      {{@$mes}}     DEL   {{@$anio}}   </td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Datos del Instrumento Público</td>
        <td class="col-7 tb-td">&nbsp;Fecha:&nbsp;   {{@$escritura_publica->fecha}}        Número:&nbsp; {{@$escritura_publica->numero}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Escribano de Cámara y de Gobierno</td>
        <td class="col-7 tb-td">&nbsp;{{@$escritura_publica->escribano}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Objeto del contrato</td>
        <td class="col-7 tb-td">&nbsp;{{@$escritura_publica->objeto_contrato}}</td>
    </tr>
</table>


<br>
<table  width="100%" class="tabla">
    <tr>
        <td class="gray tb-td text-center" colspan="2">DATOS DEL SOLICITANTE</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Nombre completo:</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitante->nombre_completo}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Número de DPI</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitante->cui}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Lugar para recibir notificación</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitante->direccion_notificacion}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Teléfono</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitante->telefono}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Correo Electrónico</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitante->correo_electronico}}</td>
    </tr>
</table>

<br>
<table  width="100%" class="tabla">
    <tr>
        <td class="gray col-12 tb-td text-center" colspan="2">DOCUMENTOS SOLICITADOS</td>
    </tr>
    <tr>
        <td class="gray col-10 tb-td" >Descripción</td>
        <td class="gray col-2 tb-td">Firma</td>
    </tr>
    <tr>
        <td class="col-10 tb-td"  style="min-height: 300px;">
        <ul>
            @if (str_contains($escritura_publica->documentos, "1"))
                <li>Copia simple</li>
            @endif
            @if (str_contains($escritura_publica->documentos, "2"))
                <li>Copia simple legalizada</li>
            @endif
            @if (str_contains($escritura_publica->documentos, "3"))
                <li>Testimonio</li>
            @endif
            @if (str_contains($escritura_publica->documentos, "4"))
                <li>Testimonio con duplicado</li>
            @endif
        </ul>
        </td>
        <td class="col-2 tb-td"></td>
    </tr>
</table>

{{-- <br>
<table  width="100%" class="tabla">
    <tr>
        <td class="gray tb-td text-left" colspan="2">Observaciones</td>
    </tr>
    <tr>
        <td class="gry col-8 " colspan="2">{{@$data->observaciones}}</td>
    </tr>
</table> --}}

<br>
<table  width="100%" class="tabla">
    <tr>
        <td class="gray tb-td text-center" colspan="2">CONTROL INTERNO</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Número</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitud->gestion}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Fecha de Recepción</td>
        <td class="col-7 tb-td">&nbsp;{{@$solicitud->fecha_recepcion}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Fecha de entrega</td>
        <td class="col-7 tb-td">&nbsp;{{@$cita->fecha}}</td>
    </tr>
    <tr>
        <td class="gray col-5 tb-td" >Horario de Cita</td>
        <td class="col-7 tb-td">&nbsp;{{@$cita->horario->catalogo_item}}</td>
    </tr>
</table>

<br>
<br>
<br>
<br>
<br>
<br>
<table  width="100%" >
    <tr>
        <td class="col-1 " ></td>
        <td class="col-4 text-center" style="border-top:1px solid  black;">Firma solicitud</td>
        <td class="col-1 "></td>
        <td class="col-1 "></td>
        <td class="col-4 text-center" style="border-top:1px solid  black;">Firma Responsable de Búsqueda</td>
        <td class="col-1 "></td>
    </tr>
</table>

</div>


<style>
    body{
        font-family: sans-serif;
    }
    @page {
        margin: 160px 50px;
    }
    header { position: fixed;
        left: 0px;
        top: -160px;
        right: 0px;
        height: 100px;
        /*background-color: #ddd;*/
        text-align: center;
    }
    header h1{
        margin: 10px 0;
    }
    header h2{
        margin: 0 0 10px 0;
    }
    footer {
        position: fixed;
        left: 0px;
        bottom: -50px;
        right: 0px;
        height: 40px;
        /*border-bottom: 2px solid #ddd;*/
    }
    footer .page:after {
        content: counter(page);
    }
    footer table {
        width: 100%;
    }
    footer p {
        text-align: right;
    }
    footer .izq {
        text-align: left;
    }

</style>
</body>
</html>
