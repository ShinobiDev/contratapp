<!--MODAL PARA CAMBIAR FECHA CIERRE-->
		            <div class="modal fade" id="fechacierreproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Fecha de cierre del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('cambiar_fecha_cierre',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Fecha de cierre</label>
		                                   <input type="date" name="fecha_cierre" min="{{date('Y-m-d')}}" value="{{$p->fecha_cierre}}">
		                                    
		                                  </div>
		                                 
		                                  <button type="submit" class="btn btn-success">Guardar Fecha de cierre</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>