<!--MODAL PARA VER OBSERVACIONES DE PROCESOS-->
<div class="modal fade" id="verobservacionesproceso{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="registrarprocesoabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="editarempresalabel">Observaciones del proceso <strong>{{$p->numero_proceso}}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body responsive" >
                    
                   
                      <div class="form-group">
                      	  
                       <label for="exampleFormControlTextarea1" class="text-danger">Proceso {{$p->numero_proceso}}</label>
                       
                      </div>
                      <div class="form-group" style="overflow-y: auto; height: 450px;" >
                      	
                      	

                       <table class="table">
            						  <thead>
            						    <tr>
            						      
            						      <th scope="col" class="bg-danger">Usuario</th>
            						      <th scope="col">Observación</th>
            						      <th scope="col" class="bg-danger">Fecha Observación</th>
            						    </tr>
            						  </thead>

            						  <tbody >
  						  	            @forelse($p->observaciones as $ob)

                                	@if($ob->observacion != null)                         		
                                    <tr>
              									      <th class="{{$r=($ob->tipo_observacion=='auto') ? 'text-red' : 'text-success'}} bg-danger" scope="row" >{{$ob->usuario_observaciones->name}}</th>	      
              									      <td class="{{$r=($ob->tipo_observacion=='auto') ? 'text-red' : 'text-success'}} ">{{$ob->observacion}}</td>
              									      <td class="{{$r=($ob->tipo_observacion=='auto') ? 'text-red' : 'text-success'}} bg-danger">{{$ob->created_at}}</td>
              									    </tr>			    
                                 	@endif		                                   		
                             	@empty
                                 		<tr>
      							                 <th scope="row" colspan="3" class="btn-info text-center"><h5>No hay observaciones registradas para el proceso <strong>{{$p->numero_proceso}}</strong></h5></th>	      
      							      
      							                </tr>
                             	 
                              @endforelse            						    
            						  </tbody>
            						</table>



                      </div>
                     
                      
                  </div>
                  <div class="modal-body">
                  	<div class="btn btn-danger btn-sm"></div> <small class="text-red">Observaciones del sistema.</small>
                  	<br>
                  	<div class="btn btn-success btn-sm"></div> <small class="text-success">Observaciones de los asesores.</small>
                  </div>	
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
		                                
                </div>
            </div>
    </div>
</div>