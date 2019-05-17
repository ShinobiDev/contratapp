<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Event;
use Carbon\Carbon;
use App\User;
use App\ControlProceso;


class ProximoCierreProceso extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proceso:cierre_proximo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando notificara de un próximo cierre';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   $tresdiasdespues=Carbon::now()->addDays('3')->format('Y-m-d');

        $procesos=ControlProceso::whereDate('fecha_cierre',$tresdiasdespues)->get();
        //dump($tresdiasdespues,$procesos);
        $uadmin=User::role('Admin')->get();
        $suadmin=User::role('Super-Admin')->get();

        //FAKLTA ENVIAR MAIL AL EMPLEADO
        //dump($suadmin);
        foreach ($procesos as $key => $value) {
                foreach($uadmin as $u){
                    Event::dispatch($u, $value,"ProximoCierre");
                    sleep(10);
                }
                foreach($suadmin as $u){
                    Event::dispatch($u, $value,"ProximoCierre");
                    sleep(10);
                }
                $comercial=User::where('id',$value->id_usuario_asignado)->first();
                Event::dispatch($comercial, $value,"ProximoCierre");
                sleep(10);

                
        }
    }
    
}
