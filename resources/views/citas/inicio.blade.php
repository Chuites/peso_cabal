@extends('layouts.app2')

@section('content')
<style type="text/css">
    .requerido:after {
        content: " *"; color: red;
    }
    #listadoTabla th {
        background-color: #337ab7;
        color: #fff;
        font-size: 12px;

        font-weight: bold;
    }
    .listadoTabla th {
        background-color: #337ab7;
        color: #fff;
        /* font-size: 12px; */
    }

    .listadoTabla thead {
        background-color: #337ab7;
        color: #fff;
    }
        /* ---- reset ---- */

    /* body {
    margin: 0;
    font:normal 75% Arial, Helvetica, sans-serif;
    } */

    canvas {
    display: block;
    vertical-align: bottom;
    }

    /* ---- particles.js container ---- */

    #particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #1f8cc2;
    background-image: url("");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 50%;
    z-index: -1;
    }

    /* ---- stats.js ---- */

    .count-particles{
    background: #ffffff;
    position: absolute;
    top: 48px;
    left: 0;
    width: 80px;
    color: #13E8E9;
    font-size: .8em;
    text-align: left;
    text-indent: 4px;
    line-height: 14px;
    padding-bottom: 2px;
    font-family: Helvetica, Arial, sans-serif;
    font-weight: bold;
    }

    .js-count-particles{
    font-size: 1.1em;
    }

    #stats,
    .count-particles{
    -webkit-user-select: none;
    }

    #stats{
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    }

    .count-particles{
    border-radius: 0 0 3px 3px;
    }
</style>

<div class="container" style="padding-top: 10%;">

    <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row " align="center" style="padding: 10px;">
                        <img src="{{ asset('img/min_gob.png') }}" width="500" height="200"><br><br>
                        <h1>Citas en Línea</h><br><br>
                        <button class="btn btn-success" id="btnCita" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agendar cita</button>
                        <br>
                        <a href="#" id="btn_bsolicitud" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;Buscar Solicitud</a>
                    </div>
                </div>
            </div>
    </div>
</div>

{{-- MODAL DE BUSQUEDA DE SOLICITUD --}}
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_bsolicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
            {{-- Se omite el boton de cerrar del modal --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda | <small id="modalSubtitle">Solicitud</small></h4>
            </div>
            <div class="modal-body">
                <center>
                    <form id="">
                        <div class="row">
                            <label for="cui_busqueda">Ingere su numero de DPI</label>
                            <input type="number" name="cui_busqueda" id="cui_busqueda">
                        </div>
                    </form>

                <div id="contenedor">
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-bordered table-striped" id="listadoTabla">
                                    <thead>
                                        <th class="dt-head-center">Gestion</th>
                                        <th class="dt-head-center">DPI</th>
                                        <th class="dt-head-center">Tipo de Solicitud</th>
                                        <th class="dt-head-center">Fecha Solicitud</th>
                                        <th class="dt-head-center">Horario</th>
                                        <th class="dt-head-center" width="105">Acciones</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer centrado_vertical">
                &nbsp;
                <a href="#" id="btn_buscarsolicitud" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Buscar</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{{ Html::style('sources/DataTables-1.10.12/css/jquery.dataTables.css') }}
{{ Html::script('sources/DataTables-1.10.12/js/jquery.dataTables.js') }}
{{ Html::script('sources/DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}
{{ Html::script('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js') }}
{{ Html::script('js/toastr.js') }}
{{ Html::style('css/toastr.css') }}
    <script type="text/javascript">
        $("#cui_busqueda").on("keydown",function search(e) {
            if(e.keyCode == 13) {
                document.querySelector('#btn_buscarsolicitud').click();
            }
        });

        $("#btnCita").click(function(){
            window.location="{{route('solicitudIndex')}}";
        });

        $("#btn_bsolicitud").click(function(){
            $("#modal_bsolicitud").modal('show');
        });

        $('#btn_buscarsolicitud').click(function(){
            if ($("#cui_busqueda").val() != "") {
                $("#listadoTabla").dataTable().fnDestroy();
                ruta = "{{route('buscarSolicitud')}}" + '/' + $("#cui_busqueda").val();
                // CARGA DE DATOS EN LA LISTA
                $('#listadoTabla').DataTable({
                    columnDefs: [
                        { className: "dt-body-center", targets: [ 1 ]}
                    ],
                    language: {
                        url: "{!! asset('sources/DataTables-1.10.12/languages/Spanish.json') !!}"
                    },
                    order: [1,'asc'],
                    bFilter : false, //oculta filtros
                    paging: false,
                    lengthMenu: {{ config('constantes.datatableListRows') }},
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: ruta,
                        type: 'POST',
                        data : function (d) {
                            d._token = $("#token").val();
                            d.criterio = $("#criterio").val();
                        }
                    },
                });
            }else{
                toastr.error('Ingrese su numero de DPI')
            }
        });

        let identificadorTiempoDeEspera;
        function temporizadorDeRetraso() {
            identificadorTiempoDeEspera = setTimeout(imprimir, 2000);
        };
        function imprimir() {
            toastr.success('Boleta desacargada correctamente')
        };

        /* ---- particles.js config ---- */

        particlesJS("particles-js", {
        "particles": {
            "number": {
            "value": 12,
            "density": {
                "enable": true,
                "value_area": 800
            }
            },
            "color": {
            "value": "#003657"
            },
            "shape": {
            "type": "polygon",
            "stroke": {
                "width": 0,
                "color": "#000"
            },
            "polygon": {
                "nb_sides": 6
            },
            "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
            }
            },
            "opacity": {
            "value": 0.3,
            "random": true,
            "anim": {
                "enable": false,
                "speed": 1,
                "opacity_min": 0.1,
                "sync": false
            }
            },
            "size": {
            "value": 80,
            "random": true,
            "anim": {
                "enable": true,
                "speed": 10,
                "size_min": 40,
                "sync": false
            }
            },
            "line_linked": {
            "enable": true,
            "distance": 200,
            "color": "#ffffff",
            "opacity": 1,
            "width": 2
            },
            "move": {
            "enable": true,
            "speed": 8,
            "direction": "none",
            "random": true,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
                "enable": true,
                "rotateX": 600,
                "rotateY": 1200
            }
            }
        },
        "interactivity": {
            "detect_on": "window",
            "events": {
            "onhover": {
                "enable": true,
                "mode": "grab"
            },
            "onclick": {
                "enable": true,
                "mode": "repulse"
            },
            "resize": true
            },
            "modes": {
            "grab": {
                "distance": 400,
                "line_linked": {
                "opacity": 1
                }
            },
            "bubble": {
                "distance": 400,
                "size": 5,
                "duration": 2,
                "opacity": 8,
                "speed": 3
            },
            "repulse": {
                "distance": 200,
                "duration": 0.4
            },
            "push": {
                "particles_nb": 4
            },
            "remove": {
                "particles_nb": 2
            }
            }
        },
        "retina_detect": true
        });


        /* ---- stats.js config ---- */

        var count_particles, stats, update;
        stats = new Stats;
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
        count_particles = document.querySelector('.js-count-particles');
        update = function() {
        stats.begin();
        stats.end();
        if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
        }
        requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    </script>
@endsection
