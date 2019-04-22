<!--MODAL PARA CAMBIAR ESTADOSS-->
<div class="modal fade" id="cambiarestadoproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="cambiarestadoprocesolabel" aria-hidden="true">
		                          <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                              <div class="modal-header">
		                                <h5 class="modal-title" id="editarempresalabel">Cambiar estado del proceso <strong>{{$p->numero_proceso}}</strong></h5>
		                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                  <span aria-hidden="true">&times;</span>
		                                </button>
		                              </div>
		                              <div class="modal-body">
		                                
		                               
		                                <form  method="POST" action="{{ route('cambiar_estados',$p->id) }}">
			                                  <div class="form-group">
			                                      {{ csrf_field() }}
			                                  </div>  
		                                 	 <div class="form-group">
		                                  	  
			                                   <label for="exampleFormControlTextarea1">Estado actual: <strong class="text-red">{{$p->estado_proceso}}</strong></label>
			                                   <select id="selEstado" class="form-control" name="estado_proceso">
			                                   		<option value="0">Selecciona un nuevo estado</option>
			                                   		<option value='Borrador'>Borrador</option>
			                                   		<option value="Convocado">Convocado</option>
			                                   		<option value="Adjudicado">Adjudicado</option>
			                                   		<option value="Celebrado">Celebrado</option>
			                                   		<option value="Liquidado">Liquidado</option>
			                                   		<option value="Descartado">Descartado</option>
			                                   		<option value="Terminado Anormalmente después de Convocado">Terminado Anormalmente después de Convocado</option>
			                                   		<option value="Terminado sin Liquidar">Terminado sin Liquidar</option>
			                                   		
			                                   </select>
			                                   
			                                  </div>
			                                  <div class="form-group">
				                                  	<label for="exampleFormControlTextarea1">Gestión comercial proceso: <strong class="text-green">{{$p->gestion_comercial}}</strong></label>
				                                  	<select id="selGestion" class="form-control" name="gestion_comercial">
				                                   		<option value="0">Selecciona un nuevo estado</option>
				                                   		<option value="Encontrado">Encontrado</option>
				                                   		<option value="No cumplimos">No cumplimos</option>
				                                   		<option value="Pendiente Propuesta">Pendiente Propuesta</option>
				                                   		<option value="Propuesta Presentada">Propuesta Presentada</option>
				                                   		<option value="Adjudicado">Adjudicado</option>
				                                   		<option value="No Adjudicado">No Adjudicado</option>
					                                </select>	
			                                  </div>
			                                   <button type="submit" class="btn btn-warning">Guardar cambios</button>  
		                                </form>
		                                 
		                                  
		                              </div>
		                              <div class="modal-footer">
		                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
		                              </div>
		                            </div>
		                          </div>
		            </div>