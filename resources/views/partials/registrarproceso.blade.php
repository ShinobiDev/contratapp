<!--MODAL PARA REGISTRAR UNA OBSERVACION-->
		    		<div class="modal fade" id="registrarproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Regitro de observaciones del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                                <form  method="POST" action="{{ route('registrar_observacion',$p->id) }}">
		                                  <div class="form-group">
		                                      {{ csrf_field() }}
		                                  </div>  
		                                  <div class="form-group">
		                                  	  
		                                   <label for="exampleFormControlTextarea1">Observación</label>
		                                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observacion" placeholder="Ingresa aquí las observaciones del proceso"></textarea>
		                                   <input type="hidden" name="id_usuario" value="{{auth()->user()->id}}">

		                                    
		                                  </div>
		                                 
		                                  <button type="submit" class="btn btn-info">Guardar Observación</button>    
		                                </form>
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>
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
		                                   <input type="date" name="fecha_cierre" value="{{$p->fecha_cierre}}" min="{{date('Y-m-d')}}">
		                                    
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