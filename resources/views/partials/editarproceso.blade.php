		        	<div class="modal fade" id="editarproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="editarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Cambiar usuario del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('editar_proceso',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                    <label for="exampleInputEmail1"> Usuario asignado</label>
		                                   </div>
		                                   <div class="form-group">
		                                   
			                                <select class="form-control"  name="nuevo_usuario" id="selUserEdi"  >
	                                             <option>selecciona un usuario</option>   
	                                         


	                                          @forelse ($users as $u)
	                                          	
	                                            @if($u->name==$p->usuario->name)
	                                              <option value="{{$p->usuario->id}}" selected>{{$u->name}}</option>
	                                            @else
	                                            
	                                              <option value="{{$u->id}}">{{$u->name}}</option>
	                                            @endif
	                                            
	                                          @empty
	                                            <option>No hay roles</option>
	                                          @endforelse
	                                        </select>
		                                    
		                                  </div>
		                                 	
		                                  <button type="submit" class="btn btn-danger">Guardar cambios</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>