<?php

namespace Database\Seeders;

use App\Models\Compania;
use App\Models\Entidad;
use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
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

    public function pordefecto(){
        $empresa = Compania::whereNombre("Prueba")->first();

        Rol::updateOrCreate(["descripcion" => 'Agente'], ["idEmpresa" => $empresa->id]);
        $agente = Rol::whereDescripcion("Agente")->first();
        if($agente != null){
            $entidades = Entidad::whereIn("descripcion", ["Clientes", "Cajas", "Prestamos"])->get();
            $entidades = collect($entidades)->map(function($data){
                return $data["id"];
            });

            $permisos = Permiso::whereIn("idEntidad", $entidades)->get();
            $permisos = collect($permisos)->map(function($d) use($agente){
                return ['idPermiso' => $d['id'], 'idRol' => $agente["id"]];
            });
            $agente->permisos()->attach($permisos);
        }

        $agente = Rol::updateOrCreate(["descripcion" => 'Supervisor'], ["idEmpresa" => $empresa->id]);
        if($agente != null){
            $entidades = Entidad::whereIn("descripcion", ["Clientes", "Cajas", "Prestamos", "Pagos"])->get();
            $entidades = collect($entidades)->map(function($data){
                return $data->id;
            });

            $permisos = Permiso::whereIn("idEntidad", $entidades)->get();
            $permisos = collect($permisos)->map(function($d) use($agente){
                return ['idPermiso' => $d['id'], 'idRol' => $agente["id"]];
            });
            $agente->permisos()->attach($permisos);
        }

        $agente = Rol::updateOrCreate(["descripcion" => 'Cobrador'], ["idEmpresa" => $empresa->id]);
        if($agente != null){
            $entidades = Entidad::whereIn("descripcion", ["Clientes", "Cajas", "Prestamos", "Pagos"])->get();
            $entidades = collect($entidades)->map(function($data){
                return $data->id;
            });

            $permisos = Permiso::whereIn("idEntidad", $entidades)->get();
            $permisos = collect($permisos)->map(function($d) use($agente){
                return ['idPermiso' => $d['id'], 'idRol' => $agente["id"]];
            });
            $agente->permisos()->attach($permisos);
        }

        $agente = Rol::updateOrCreate(["descripcion" => 'Programador'], ["idEmpresa" => $empresa->id]);
        if($agente != null){
            $entidades = Entidad::all();
            $entidades = collect($entidades)->map(function($data){
                return $data->id;
            });

            $permisos = Permiso::whereIn("idEntidad", $entidades)->get();
            $permisos = collect($permisos)->map(function($d) use($agente){
                return ['idPermiso' => $d['id'], 'idRol' => $agente["id"]];
            });
            $agente->permisos()->attach($permisos);
        }
    }
}
