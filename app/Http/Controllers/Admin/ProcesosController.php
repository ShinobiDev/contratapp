<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ControlProceso;

class ProcesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cp=ControlProceso::all();
        return view('procesos.index')->with('procesos',$cp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('procesos.register');
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
        dd($request,$id);
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
    public function subir_archivos_procesos(Request $request,$empresa,$id_usuario){
        
        $this->validate(request(),[
            //'file'=>'required|max:10240|mimetypes:application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/csv, text/anytext, text/plain, text/x-c,text/comma-separated-values,inode/x-empty,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);

        $url=$request->file('file');

        
        $filename = $request->file('file')->move('archivos/');

        $newname="/archivoexcel.".explode(".",$_FILES['file']['name'])[1];

        rename($filename,realpath(dirname($filename)).$newname);
        $datos=ControlProceso::obtener_datos_archivo($newname);
      //  dd($datos);
        foreach($datos as $d ){
            //dump($d);
            $fecha=array_reverse(explode("-",explode("\n",$d[9])[1]));
            //dump($fecha);
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
                'id_empresa'=>$empresa,
                'id_detalle_usuario_empresa_asignado'=>$id_usuario                
                
            ]);
        }

        return  response()->json(['respuesta'=>true,'mensaje'=>'Se agregado los registros satisfactoriamente']);                       
       
    }
}
