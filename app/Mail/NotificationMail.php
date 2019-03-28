<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{

  public $user;
  public $datos;  
  public $tipo;
  


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $datos, $tipo)
    {
       //dd([$user, $ad, $recarga,$tipo,$url]);
       $this->user = $user;
       $this->datos = $datos;
       $this->tipo = $tipo;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->tipo);
        switch ($this->tipo) {
            case 'UsuarioCreado':
                return $this->markdown('emails.credenciales')
                            ->subject('Datos de acceso para '. config('app.name'));
                # code...
                break;                   
            default:
                dd($this->tipo);
                # code...
                break;
        }

    }
}
