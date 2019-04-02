<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Events\Event;
use App\User;
use App\DetalleUsuarioEmpresa;
use App\Empresa;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

        switch (auth()->user()->getRoleNames()[0]) {
            case 'Super-Admin':
                $r=Role::all();    
                $u=User::all();
                break;
            case 'Admin':
                //pendientes relaciones 
                $r=Role::where('name','!=','Super-Admin')->get();
                $u=User::all();
                break;    
            
            default:
                $r=Role::where('name','Comerciante')->get();
                $u=User::where('id',auth()->user()->id)->get();
                break;
        }
       
        
        return view('usuarios.index')
                    ->with('usuarios',$u)
                    ->with('roles',$r);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $r=Role::all();
        $e=Empresa::all();
        return view('auth.register')
                    ->with('roles',$r)
                    ->with('empresas',$e);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data =  $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'rol'=>'required',
            'empresa'=>'',
        ]);
        
        if($data['rol']=="selecciona un rol"){
            return back()->with("error",'Debes seleccionar un rol');
        }
        /*if($data['empresa']=='selecciona una empresa' && $data['rol']!='1'){
            return back()->with("error",'Debes seleccionar una empresa');
        }*/
        $data['password']=str_random(8);
        
        $u = new User;
        $u->name=$data['name'];
        $u->email=$data['email'];
        $u->password=bcrypt($data['password']);
        $u->save();
        $u->assignRole(Role::where('id',$data['rol'])->first());

       
        Event::dispatch($u, $data['password'],"UsuarioCreado");

        return back()->with("success",'Usuario creado exitosamente');
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
        
        $data =  $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'',
            'rol'=>''
        ]);
        
        if(($request['password'][0] != "" && $request['password'][1] != "") && ($request['password'][1]==$request['password'][0])){

            User::where('id',$id)->update([
                    'password'=>bcrypt($data['password'][0])                    
                    ]);
        }else if(($request['password'][0] != "" && $request['password'][1] != "") && ($request['password'][1]!=$request['password'][0])){
            return back()->with('error','Las contraseñas deben coincidir');
        }

        

        User::where('id',$id)->update([
                    'name'=>$data['name'],
                    'email'=>$data['email']
                    ]);

        return back()->with("success",'Usuario editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->update(['estado'=>'0']);
        return back()->with("success",'Usuario deshabilitado exitosamente');
    }

    public function ver_perfil(){
          return view('usuarios.perfil')
                    ->with('usuario',auth()->user());
                    
    }
}
