@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        
            
        

          <table id="usuarios-table" class="table table-striped table-codensed table-hover table-resposive">
              <thead>
                <tr>
                  <th class="text-center">Nombre</th>
                  <th>rol</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>
                
                @forelse ($usuarios as $u)

                   <tr id="row_{{$u->id}}">      
                      <td class="text-green text-center"><strong><h4>{{strtoupper($u->name)}}</h4></strong></td>
                      <td ><strong><h4>{{$u->getRoleNames()[0]}}</h4></strong></td>
                      <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarusuario{{$u->id}}">
                          Editar usuario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editarusuario{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="editarusuariolabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editarusuariolabel">Editar usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <form  method="POST" action="{{ route('editar_usuario',$u->id) }}">
                                  <div class="form-group">
                                      {{ csrf_field() }}
                                  </div>  
                                  <div class="form-group">
                                    
                                    <label for="exampleInputName">Nombre usuario</label>
                                    <input type="text" name="name" class="form-control"   placeholder="Ingresa el nuevo nombre de la usuario" value="{{$u->name}}" required>
                                    
                                  </div>
                                  <div class="form-group">
                                    
                                    <label for="exampleInputEmail">Correo usuario</label>
                                    <input type="text" name="email" class="form-control"   placeholder="Ingresa el nuevo correo del usuario" value="{{$u->email}}" required>
                                    
                                  </div>
                                  <div class="form-group">
                                       <select class="form-control"  name="rol" id="selRolesEdi" onchange="validar_rol(this);" required>
                                             <option>selecciona un rol</option>   
                                          @forelse ($roles as $r)

                                            @if($u->getRoleNames()[0]==$r->name)
                                              <option value="{{$r->id}}" selected>{{$r->name}}</option>
                                            @else
                                              <option value="{{$r->id}}">{{$r->name}}</option>
                                            @endif
                                            
                                          @empty
                                            <option>No hay roles</option>
                                          @endforelse
                                        </select>
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
                      <td class="text-green text-center"><strong><h4>Aun no existen usuarios registradas</h4></strong></td>
                      <td>
                        <a href="{{route('register')}}" class="btn btn-info">Crear usuario</a>
                    </td>
                   </tr>
                @endforelse

                
                
              </tbody>
              
          </table>
          <a href="{{route('register')}}" class="btn btn-info">Crear usuario</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')

          <script>
            $(document).ready(function() {
                $('#selRolesEdi').select2();
                $('#usuarios-table').DataTable( {
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