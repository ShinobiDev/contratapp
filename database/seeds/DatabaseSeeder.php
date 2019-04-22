<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
use App\Empresa;
use App\DetalleEmpresaUsuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        
        $sadmin=Role::create(['name'=>'Super-Admin']);
        $admin=Role::create(['name'=>'Admin']);
        $usuario=Role::create(['name'=>'Comerciante']);


        User::truncate();
        $u1 = new User;
        $u1->name="Edgar gmail";
        $u1->email="edgar.guzman21@gmail.com";
        $u1->password=bcrypt('123456');
        $u1->save();
        $u1->assignRole($usuario);



        $u2 = new User;
        $u2->name="Adrian outlook";
        $u2->email="adrian.vargas.2018@outlook.com";
        $u2->password=bcrypt('123456');
        $u2->save();
        $u2->assignRole($usuario);
      


        $us = new User;
        $us->name="Soporte Prisma Web";
        $us->email="soporte@prismaweb.net";
        $us->password=bcrypt('33S0p0rt3PW522**');
        $us->save();
        $us->assignRole($sadmin);

        $ua = new User;
        $ua->name="El man de soporte de gmail";
        $ua->email="edgar.devmohan@gmail.com";
        $ua->password=bcrypt('123456');
        $ua->save();
        $ua->assignRole($admin);

        Empresa::truncate();
        $em = new Empresa();
        $em->nombre_empresa="Prisma web";
        $em->save();


        $em1 = new Empresa();
        $em1->nombre_empresa="Empresa 1";
        $em1->save();

        $em2 = new Empresa();
        $em2->nombre_empresa="Empresa 2";
        $em2->save();
        
        DetalleEmpresaUsuario::truncate();
        $deu=new DetalleEmpresaUsuario();
        $deu->id_usuario=$u1->id;
        $deu->id_empresa=$em->id;
        $deu->save();

        $deu=new DetalleEmpresaUsuario();
        $deu->id_usuario=$u2->id;
        $deu->id_empresa=$em1->id;
        $deu->save();

        $deu=new DetalleEmpresaUsuario();
        $deu->id_usuario=$ua->id;
        $deu->id_empresa=$em->id;
        $deu->save();

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
