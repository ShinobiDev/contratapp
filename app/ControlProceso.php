<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlProceso extends Model
{
    //
    protected $fillable = [
        'numero_proceso', 'link_proceso', 'entidad','objeto','dpto_ciudad','cuantia','fecha_apertura','tipo_proceso','estado_proceso','id_usuario_asignado','id_empresa'
    ];
    public function usuario(){
        return $this->belongsTo(User::class,'id_usuario_asignado');
    }    
    public function empresa(){
        return $this->belongsTo(Empresa::class,'id_empresa');
    }
    public function observaciones(){
    	return $this->hasMany(ObservacionProceso::class,'id_control_proceso');
    }



    public static function obtener_datos_archivo($archivo){
    	$inputFileName = realpath('../public/archivos/'.$archivo);

        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        //dd($spreadsheet);
        $loop=$spreadsheet->getActiveSheet();
        //dd($loop);
        $mis_datos=[];
        $f=0;
        foreach ($loop->getRowIterator() as $fila) {
            //dump($fila);
            $cellIterator = $fila->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(TRUE);
            $mis_celdas=[];
            $c=0;
            foreach ($cellIterator as $cell) {
                 /*echo $cell->getValue()."</br>"; 
                 $arr=explode("?",$cell->getHyperlink()->getUrl());
                 if(count($arr)>1){
                    echo substr($arr[1],0,-2)."<br>";
                 } */
                 if($cell->getValue()!=""){
                 	 $arr=explode("?",$cell->getHyperlink()->getUrl());
	                 if(count($arr)>1){
	                    $mis_celdas[$c]=(string)$cell->getValue();
	                    
	                    $c++;  
	                    $mis_celdas[$c]=substr($arr[1],0,-2);
	                    //echo (string)$cell->getValue()."<br>";
	                    $c++;  
	                    //echo $c."-".$mis_celdas[$c]."<br>";
	                 }else{
	                    $mis_celdas[$c]=$cell->getValue();
	                    $c++;
	                 }	
                 }
                 
           
            }
            if($f>0 && count($mis_celdas)==10){
            	$mis_datos[$f]=$mis_celdas;	
            }
            
            $f++;
        }
        return $mis_datos;
    }
}
