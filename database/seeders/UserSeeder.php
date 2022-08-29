<?php

namespace Database\Seeders;

use App\Models\Compania;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }

    public function crearUsuarioPorDefecto(){
        $compania = Compania::whereNombre("Prueba")->first();

        $contactoUsuario = \App\Contacto::updateOrCreate(
            ["correo" => "jeancon29@gmail.com"],
            [
                "telefono" => "8294266800",
                "celular" => "8493406800",
            ]
        );

        $rol = \App\Rol::whereDescripcion("Programador")->first();

        $usuario = \App\User::updateOrCreate(
            ["usuario" => "jeancc29"],
            [
                "password" => Crypt::encryptString(\config('data.password')),
                "nombres" => "Jean Carlos",
                "apellidos" => "Contreras Rodriguez",
                "status" => 1,
                "idSucursal" => 1,
                "idContacto" => $contactoUsuario->id,
                "idEmpresa" => $compania->id,
                "idRol" => $rol->id,
            ]
        );

        $permisos = collect($rol->permisos)->map(function($d) use($usuario){
            return ["idPermiso" => $d["id"], "idUsuario" => $usuario->id];
        });
        $usuario->permisos()->detach();
        $usuario->permisos()->attach($permisos);
    }
}
