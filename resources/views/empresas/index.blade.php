@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          aqui va la tabla
          <table id="empresas-table" class="table table-striped table-codensed table-hover table-resposive">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>
                
                @forelse ($empresas as $e)
                   <tr id="row_{{$e->id}}">      
                      <td class="text-green text-center"><strong><h4>{{strtoupper($e->nombre_empresa)}}</h4></strong></td>
                      <td>accion</td>
                   </tr>
                @empty
                    <tr id="row_{{$e->id}}">      
                      <td class="text-green text-center"><strong><h4>{{strtoupper($e->nombre_empresa)}}</h4></strong></td>
                   </tr>
                @endforelse

                
                
              </tbody>
              
          </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')

          <script>
            $(document).ready(function() {
                console.log("5");
                $('#empresas-table').DataTable( {
                    responsive: true,
                    stateSave: true,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    language:
                      {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                } );
                filtro_url('#compras-table');


            });
          </script>


@endsection