@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        
            
        

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
                      <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarempresa{{$e->id}}">
                          Editar empresa
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editarempresa{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="editarempresalabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editarempresalabel">Editar empresa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <form  method="POST" action="{{ route('editar_empresa',$e->id) }}">
                                  <div class="form-group">
                                      {{ csrf_field() }}
                                  </div>  
                                  <div class="form-group">
                                    
                                    <label for="exampleInputEmail1">Nombre empresa</label>
                                    <input type="text" name="nombre_empresa" class="form-control"   placeholder="Ingresa el nuevo nombre de la empresa" value="{{$e->nombre_empresa}}">
                                    
                                  </div>
                                  
                                   <button type="submit" class="btn btn-primary">Guardar cambios</button>   
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                   </tr>
                @empty
                    <tr >      
                      <td class="text-green text-center"><strong><h4>Aun no existen empresas registradas</h4></strong></td>
                      <td>
                        <a href="{{route('registrar_empresa')}}" class="btn btn-info">Crear empresa</a>
                    </td>
                   </tr>
                @endforelse

                
                
              </tbody>
              
          </table>

          <a href="{{route('registrar_empresa')}}" class="btn btn-success">Crear empresa</a>
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