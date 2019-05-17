<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ControlProceso;
use App\User;
use App\Empresa;
use App\ObservacionProceso;



class ProcesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(auth()->user()->getRoleNames()[0]=='Comerciante'){

            $cp=ControlProceso::where('id_usuario_asignado',auth()->user()->id)
                            ->orderBy('fecha_cierre','DESC')
                            ->get();
            
            $u=User::role('Comerciante')->get();    
            return view('procesos.index')
                    ->with('procesos',$cp)
                    ->with('users',$u);
        }else{
            $cp=ControlProceso::all();
            $u=User::role('Comerciante')->get();    
            return view('procesos.index')
                ->with('procesos',$cp)
                ->with('users',$u);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        if(auth()->user()->getRoleNames()[0]!='Comerciante'){
            
            if(auth()->user()->getRoleNames()[0]=='Admin'){
                $em=Empresa::where("id",auth()->user()->detalle_empresa_usuario->first()->id_empresa)->get();


                $u=User::role('Comerciante')->get();
                $i=0;
                foreach ($u as $key => $value) {
                    if($value->detalle_empresa_usuario->first()->id_empresa==$em[0]->id){
                        $filtro[$i++]=$value->detalle_empresa_usuario->first()->id_usuario;
                    }    
                    
                }
                
                
                $us=User::whereIn('id',$filtro)->get();
                
                
            }else{

                $em=Empresa::all();
                $us=User::role('Comerciante')->get();
            }
            
        }else{
            //si es comerciante 
            $em=Empresa::where("id",auth()->user()->detalle_empresa_usuario->first()->id_empresa)->get();
            $us=auth()->user();
        }
        return view('procesos.register')
                ->with('empresas',$em)
                ->with('usuarios',$us);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request,$id);
        
        ControlProceso::where('id',$id)->update(['id_usuario_asignado'=>$request['nuevo_usuario']]);
            $uu=User::where('id',$request['nuevo_usuario'])->first();

         ObservacionProceso::create([
            'observacion'=>"Cambio de usuarios asignada a ".$uu->id.' - '. $uu->name,
            'id_usuario_observacion'=>auth()->user()->id,
            'tipo_observacion'=>'auto',
            'id_control_proceso'=>$id
        ]);
        $cp=ControlProceso::where('id',$id)->first(); 
        return back()->with("success",'Proceso # '.$cp->numero_proceso.' editado exitosamente');
    
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function subir_archivos_procesos(Request $request){
        
        try{
            $this->validate(request(),[
                //'file'=>'required|max:10240|mimetypes:application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/csv, text/anytext, text/plain, text/x-c,text/comma-separated-values,inode/x-empty,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ]);

            $url=$request->file('file');

            
            $filename = $request->file('file')->move('archivos/');

            $newname="/archivoexcel.".explode(".",$_FILES['file']['name'])[1];

            rename($filename,realpath(dirname($filename)).$newname);
            $datos=ControlProceso::obtener_datos_archivo($newname);
           
            $i=0;
            $rep=0;
            foreach($datos as $d ){
                //dump($d);
                $fecha=array_reverse(explode("-",explode("\n",$d[9])[1]));
                
                $fecha=ControlProceso::validar_fecha($fecha);
                $pro=ControlProceso::where('link_proceso',$d[2])->get();
                if(count($pro)==0){
                    ControlProceso::create([
                        'numero_proceso'=>$d[1],
                        'link_proceso'=>$d[2],
                        'tipo_proceso'=>$d[3],
                        'estado_proceso'=>$d[4],
                        'entidad'=>$d[5],
                        'objeto'=>$d[6],
                        'dpto_ciudad'=>$d[7],
                        'cuantia'=>explode('$',$d[8])[1],
                        'fecha_apertura'=>implode('-',$fecha),
                        'id_usuario_asignado'=>$request['usuario'],
                        'id_empresa'=>$request['empresa'],                
                        
                    ]);
                    $i++;
                }else{
                    $rep++;
                }
                 
            }
            $msn="";
            if($rep>0){
                $msn=" y se identificaron ".$rep." procesos repetidos los cuales no se agregaron al sistema.";
            }else{
                $msn=".";
            }
            return  response()->json(['respuesta'=>true,'mensaje'=>'Se han agregado '.$i.' registros satisfactoriamente'.$msn]);                       

        }catch(\Exception $ex){
            return  response()->json(['respuesta'=>false,'mensaje'=>'Ha ocurrido un error ' ]);   
        }
        
       
    }

    public function registrar_observacion(Request $request,$id){
        //dd($request,$id);
        ObservacionProceso::create([
            'observacion'=>$request['observacion'],
            'id_usuario_observacion'=>$request['id_usuario'],
            'id_control_proceso'=>$id,
            'tipo_observacion'=>'manual'
        ]);
        $cp=ControlProceso::where('id',$id)->first();
        return back()->with("success",'Observación registrada exitosamente, para el proceso '.$cp->numero_proceso);
    }

    public function cambiar_fecha_cierre(Request $request,$id){

        $this->validate(request(),[
            'fecha_cierre'=>'required'

        ]);
        ControlProceso::where('id',$id)
        ->update([
                'fecha_cierre'=>$request['fecha_cierre']
            ]);
        ObservacionProceso::create([
            'observacion'=>"Cambio fecha de cierre : ".$request['fecha_cierre'],
            'id_usuario_observacion'=>auth()->user()->id,
            'tipo_observacion'=>'auto',
            'id_control_proceso'=>$id
        ]);
        $cp=ControlProceso::where('id',$id)->first();
        return back()->with("success",'Fecha cambiada exitosamente, para el proceso '.$cp->numero_proceso);
    }
    public function cambiar_estados(Request $request,$proceso){
        
        
        if($request['estado_proceso']!="0"){
            
            ObservacionProceso::create([
                'observacion'=>"Cambio estado proceso : ".$request['estado_proceso'],
                'id_usuario_observacion'=>auth()->user()->id,
                'tipo_observacion'=>'auto',
                'id_control_proceso'=>$proceso
            ]);

            ControlProceso::where('id',$proceso)
                ->update([
                            'estado_proceso'=>$request['estado_proceso']
                           
                        ]);
        }

        if($request['gestion_comercial']!="0"){

            ObservacionProceso::create([
                'observacion'=>"Cambio estado gestión comercial : ".$request['gestion_comercial'],
                'id_usuario_observacion'=>auth()->user()->id,
                'tipo_observacion'=>'auto',
                'id_control_proceso'=>$proceso
            ]);

            ControlProceso::where('id',$proceso)
                ->update([
                           
                            'gestion_comercial'=>$request['gestion_comercial']
                        ]);
        }

        
        $cp=ControlProceso::where('id',$proceso)->first();
        return back()->with("success",'Estado cambiado exitosamente, para el proceso '.$cp->numero_proceso);    
    }
}
