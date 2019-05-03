@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container-fluid">
  <div class="box box-primary">
    <div class="box-header">
      <b><a href="{{route('register')}}" class="btn btn-success pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>
      Crear usuario</a></b>

    </div>
    <div class="box-body">
      <table id="usuarios-table" class="table table-striped table-codensed table-hover table-resposive">
              <thead>
                <tr class="bg-yellow">
                  <th class="text-center">Nombre</th>
                  <th>rol</th>
                  <th>estado</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>
                
                @forelse ($usuarios as $u)

                   <tr id="row_{{$u->id}}">      
                      <td class="text-green text-center bg-success"><strong><h4>{{strtoupper($u->name)}}</h4></strong></td>
                      <td ><strong><h4 class="text-red">{{$u->getRoleNames()[0]}}</h4></strong></td>
                      <td class="text-primary bg-info">{{$estado = ($u->estado == 1) ? "Activo" : "Deshabilitado"}}</td>
                      <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarusuario{{$u->id}}">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        @if($u->estado)
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarusuario{{$u->id}}">
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                        @endif
                        

                        
                        
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
          
          <!-- Modal -->
          @foreach($usuarios as $u)
            <!--MODALPARA EDITAR USUARIO-->
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
            <!--MODAL PARA DESHABILITAR USUARIO-->            
            <div class="modal fade" id="eliminarusuario{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="editarusuariolabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editarusuariolabel">Deshabilitar usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <form  method="POST" action="{{ route('deshabilitar_usuario',$u->id) }}">
                                  <div class="form-group">
                                      {{ csrf_field() }}
                                  </div>  
                                  <div class="form-group">
                                    <p>¿Estás seguro de que deseas deshabilitar a {{$u->name}}?</p>
                                    
                                  </div>
                                   <button type="submit" class="btn btn-danger">Completamente seguro</button>   
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>
          @endforeach
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