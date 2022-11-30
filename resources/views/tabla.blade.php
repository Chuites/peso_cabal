<table class=" table table-bordered table-striped listadoTabla" id="listadoTableNombresEntidad">       
    <thead>
        <th style="text-align: center;">No</th>
        <th >Nombre de la Entidad</th>
    </thead>
</table>

<script type="text/javascript">
	$(document).ready( function () { 
    $('#listadoTableNombresEntidad').DataTable({
            columnDefs: [
                { className: "dt-body-center", targets: "_all"}
            ],
            language: {
                url: "{!!  asset('sources/DataTables-1.10.12/languages/Spanish.json') !!}"
            },
            paging: true,
             searching: false,
            order: [1,'asc'],   
            lengthMenu: [[100,200],[100, 200]],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('listarNombresEntidades') }}",
                type: 'POST',
                data : function (d) {                    
                        d._token = '{{ csrf_token() }}';                    
                        d.entidad = $('#entidad').val();
                    }

            }
        }); 
    
   });
</script>