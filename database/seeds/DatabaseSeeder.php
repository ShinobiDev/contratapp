<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
use App\Empresa;

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
        $usuario=Role::create(['name'=>'Usuario']);


        User::truncate();
        $u = new User;
        $u->name="Edgar gmail";
        $u->email="edgar.guzman21@gmail.com";
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($usuario);



        $u = new User;
        $u->name="Adrian outlook";
        $u->email="adrian.vargas.2018@outlook.com";
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($usuario);
      


        $u = new User;
        $u->name="Soporte Prisma Web";
        $u->email="soporte@prismaweb.net";
        $u->password=bcrypt('33S0p0rt3PW522**');
        $u->save();
        $u->assignRole($sadmin);

        $u = new User;
        $u->name="El man de soporte de gmail";
        $u->email="edgar.devmohan@gmail.com";
        $u->password=bcrypt('123456');
        $u->save();
        $u->assignRole($admin);

        Empresa::truncate();
        $em = new Empresa();
        $em->nombre_empresa="Prisma web";
        $em->save();


        $em = new Empresa();
        $em->nombre_empresa="Empresa 1";
        $em->save();

        $em = new Empresa();
        $em->nombre_empresa="Empresa 2";
        $em->save();
        
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
