<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos de Consulta de documentos</title>
</head>
<body style="font-size: 10pt;   font-family: 'Arial, Helvetica, Verdana, Tahoma, sans-serif'">
<div id="header" style="border-bottom: 1px; font-size: 10pt; text-align: center; padding-bottom: 35mm; ">
    <table width="100%">
        <tr >

            <td width="60%">
                <h4>MINISTERIO DE GOBERNACIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    ESCRIBANIA DE CÁMARA Y DE GOBIERNO<br>
                    RESCATE FONDO HISTORICO<br>
                </h4>
            </td>
            <td width="40%">
                {{-- <img src="{{ public_path() . $image_path }}" width="225px" style="float:right "> --}}
                <?php
                    $image_path = '/img/min_gob.png';
                ?>
                <img src="{{ public_path() . $image_path }}" width="225px" style="float:right">
            </td>
        </tr>
    </table>

    <h2>CONSULTA DE DOCUMENTOS</h2>

</div>

<!--footer para cada pagina-->
<div id="footer">
    <!--aqui se muestra el numero de la pagina en numeros romanos-->
    <p style="border-top: 1px solid #000000; font-size:10pt; text-align: center; padding-top: 3mm; " ></p>
    <br>
    <table >
        <tr>
            <td width="120" align="left" valign="top" >
                {{-- <stron>Usuario:</stron> {{ /* $user_genera  */}}<br>
                <stron>F.Impresión:</stron> {{/*  $fecha */ }} --}}
            </td>
            <td width="280" align="center" valign="top" >
                Ministerio de Gobernación 6ª. Avenida<br>
                13-71 Zona 1, Sótano PBX 2413-8888<br>
                Ext. 1901, 5830
            </td>
            <td width="100" align="right" valign="top" >
                {{-- <stron>Documento:</stron> {{ /* $documento */ }}<br>
                P&aacute;gina <small class="page"></small> --}}
            </td>
        </tr>
    </table>
</div>


<div style="padding-top: -10%;">
    <div style="page-break-inside: avoid; width:100%">
        <table border="1" width="100%" cellspacing=0>
            <tr align="center">
                <td colspan="2"><b>DATOS DEL SERVICIO SOLICITADO</b></td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Fecha de solicitud</strong></td>
                <td align="left">&nbsp;{{ @$cita->fecha }}</td>
            </tr>

            <tr>
                <td width="20%" align="right"><strong>Tipo de solicitud</strong></td>
                <td align="left">&nbsp;</td>
            </tr>

            <tr>
                <td width="20%" align="right"><strong>Otros especifique</strong></td>
                <td align="left">&nbsp;</td>
            </tr>
        </table>
    </div>

    <br>

    <div style="page-break-inside: avoid; width:100%">
        <table border="1" width="100%" cellspacing=0>
            <tr align="center">
                <td colspan="2"><b>CONTROL INTERNO</b></td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Número</strong></td>
                <td align="left">&nbsp;{{@$solicitud->gestion}}</td>
            </tr>

            <tr>
                <td width="20%" align="right"><strong>Fecha de Recepción</strong></td>
                <td align="left">&nbsp;{{@$solicitud->fecha_recepcion}}</td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Fecha de entrega</strong></td>
                <td align="left">&nbsp;{{@$cita->fecha}}</td>
            </tr>
            <tr>
                <td class="gray col-5 tb-td" >Horario de Cita</td>
                <td class="col-7 tb-td">&nbsp;{{@$cita->horario->catalogo_item}}</td>
            </tr>

        </table>
    </div>

    <br>

    <div style="page-break-inside: avoid; width:100%">
        <table border="1" width="100%" cellspacing=0>
            <tr align="center">
                <td colspan="2"><b>DATOS DEL SOLICITANTE</b></td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Institucion</strong></td>
                <td align="left">&nbsp;{{ @$archivo_historico->institucion }}</td>
            </tr>

            <tr>
                <td width="20%" align="right"><strong>Nombre</strong></td>
                <td align="left">&nbsp;{{@$solicitante->nombre_completo}}  </td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Número de identificacion</strong></td>
                <td align="left">&nbsp;{{@$solicitante->cui}}</td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Teléfono(s)</strong></td>
                <td align="left">
                    &nbsp;{{@$solicitante->telefono}}
                </td>
            </tr>
            <tr>
                <td width="20%" align="right"><strong>Correo(s)</strong></td>
                <td align="left">
                    &nbsp;{{@$solicitante->correo_electronico}}
                </td>
            </tr>
        </table>
    </div>


    <br>


    <div style="page-break-inside: avoid; width:100%">
        <table border="1" width="100%" cellspacing=0>
            <tr align="center">
                <td colspan="3"><b>DOCUMENTOS SOLICITADOS</b></td>
            </tr>

            <tr >
                <th>Descripción</th>
                <th align="center">Año</th>
                <th align="center">Signatura</th>
            </tr>


            <tr>
                <td width="70%" align="left">&nbsp;{{ @$archivo_historico->descripcion }}</td>
                <td width="10%" align="center">&nbsp;{{ @$archivo_historico->anio }}</td>
                <td width="20%" align="center">&nbsp;{{ @$archivo_historico->signatura }}</td>
            </tr>

        </table>
    </div>


    <br>
    <div style="page-break-inside: avoid; width:100%">
        <table border="1" width="100%" cellspacing=0>
            <tr >
                <td><b>OBSERVACIONES</b></td>
            </tr>

            <tr >
                <td>&nbsp;{{@$archivo_historico->observaciones}}</td>
            </tr>
        </table>
    </div>


    <div style="page-break-inside: avoid; width:100%">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <table border="0" width="100%" cellspacing=0>
            <tr >
                <th width="50%" align="center"> _______________________________ </th>
                <th width="50%" align="center">____________________________________</th>
            </tr>
            <tr >
                <th width="50%" align="center">Firma Solicitante</th>
                <th width="50%" align="center">Archivo<br><small>(firma y sello)</small></th>
            </tr>
            <tr >
                <td width="50%"> <br><br><br> </td>
                <td width="50%"> </td>
            </tr>
        </table>
    </div>
</div>

<style>
    .well_pdf {
        min-height: 5px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #fff;
        border: 1px solid #5e5e5e;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    }
    /* estilos para el footer y el numero de pagina */
    @page { margin: 180px 50px; }
    #header {
        position: fixed;
        left: 0px;
        top: -150px;
        right: 0px;
        height: 30px;
        /*background-color: #333;*/
        color: #000000;
        text-align: left;
    }
    #footer {
        position: fixed;
        left: 0px;
        bottom: -100px;
        right: 0px;
        height: 0px;
        /* background-color: #333;*/
        color: #000000;
    }
    #footer .page:after {
        content: counter(page);
    }
</style>
</body>
</html>
