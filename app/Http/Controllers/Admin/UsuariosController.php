<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Events\Event;
use App\User;
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
        $e=User::all();
        return view('usuarios.index')->with('usuarios',$e);
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
        
        return view('auth.register')->with('roles',$r);
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
            'email'=>'required',
            'rol'=>'required',
        ]);
        $data['password']=str_random(8);
        
        $u = new User;
        $u->name=$data['name'];
        $u->email=$data['email'];
        $u->password=$data['password'];
        $u->save();
        $u->assignRole(Role::where('name',$data['rol'])->first());
        
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
        $data =  $request->validate([
            'name'=>'required'
        ]);
        User::where('id',$id)->update(['name'=>$data['name']]);

        return back()->with("success",'Usuario editado exitosamente');
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
}
