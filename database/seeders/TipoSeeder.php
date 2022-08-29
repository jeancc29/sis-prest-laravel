<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::updateOrCreate(["descripcion" => "Hombre"], ["renglon" => "sexo"]);
        Tipo::updateOrCreate(["descripcion" => "Mujer"], ["renglon" => "sexo"]);
        Tipo::updateOrCreate(["descripcion" => "Otro..."], ["renglon" => "sexo"]);

        Tipo::updateOrCreate(["descripcion" => "Soltero"], ["renglon" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Casado"], ["renglon" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Unión libre"], ["renglon" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Divorciado"], ["renglon" => "estadoCivil"]);
        Tipo::updateOrCreate(["descripcion" => "Viudo"], ["renglon" => "estadoCivil"]);

        Tipo::updateOrCreate(["descripcion" => "Propia"], ["renglon" => "vivienda"]);
        Tipo::updateOrCreate(["descripcion" => "Alquilada"], ["renglon" => "vivienda"]);
        Tipo::updateOrCreate(["descripcion" => "Pagando"], ["renglon" => "vivienda"]);

        Tipo::updateOrCreate(["descripcion" => "Cédula identidad"], ["renglon" => "documento"]);
        Tipo::updateOrCreate(["descripcion" => "RNC"], ["renglon" => "documento"]);
        Tipo::updateOrCreate(["descripcion" => "Pasaporte"], ["renglon" => "documento"]);

        Tipo::updateOrCreate(["descripcion" => "Ninguna"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Combustible"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Gastos Diversos"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Nómina"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Comisión Agente"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Aportaciones"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Automóvil"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Renta"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Sistema"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Pagina Web"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Imprestos"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Seguro Social"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Comisiones Bancarias"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Misceláneo"], ["renglon" => "gasto"]);
        Tipo::updateOrCreate(["descripcion" => "Almuerzo Administrativo"], ["renglon" => "gasto"]);

        Tipo::updateOrCreate(["descripcion" => "Cuota fija"], ["renglon" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Disminuir cuota"], ["renglon" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Interes fijo"], ["renglon" => "amortizacion"]);
        Tipo::updateOrCreate(["descripcion" => "Capital al final"], ["renglon" => "amortizacion"]);

        Tipo::updateOrCreate(["descripcion" => "Diario"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Semanal"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Bisemanal"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Quincenal"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "15 y fin de mes"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Mensual"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Anual"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Semestral"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Trimestral"], ["renglon" => "plazo"]);
        Tipo::updateOrCreate(["descripcion" => "Ult. dia del mes"], ["renglon" => "plazo"]);

        Tipo::updateOrCreate(["descripcion" => "Gastos de cierre"], ["renglon" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Tasacion"], ["renglon" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Cargos por seguro"], ["renglon" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Otros gastos de cierre"], ["renglon" => "gastoPrestamo"]);
        Tipo::updateOrCreate(["descripcion" => "Gastos del gps"], ["renglon" => "gastoPrestamo"]);

        Tipo::updateOrCreate(["descripcion" => "Efectivo"], ["renglon" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Cheque"], ["renglon" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Transferencia"], ["renglon" => "desembolso"]);
        Tipo::updateOrCreate(["descripcion" => "Efectivo en ruta"], ["renglon" => "desembolso"]);

        Tipo::updateOrCreate(["descripcion" => "Vehiculo"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Infraestructura"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Joyeria"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Electrodomestico"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Inmueble"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Telefono"], ["renglon" => "garantia"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["renglon" => "garantia"]);

        Tipo::updateOrCreate(["descripcion" => "Nuevo"], ["renglon" => "condicionGarantia"]);
        Tipo::updateOrCreate(["descripcion" => "Usado"], ["renglon" => "condicionGarantia"]);

        Tipo::updateOrCreate(["descripcion" => "Sedan"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Compacto"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Jeepeta"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Camioneta"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Coupe/Sport"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Camion"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Motor"], ["renglon" => "tipoVehiculo"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["renglon" => "tipoVehiculo"]);

        Tipo::updateOrCreate(["descripcion" => "Capital pendiente"], ["renglon" => "mora"]);
        Tipo::updateOrCreate(["descripcion" => "Cuota vencida"], ["renglon" => "mora"]);
        Tipo::updateOrCreate(["descripcion" => "Capital vencido"], ["renglon" => "mora"]);

        Tipo::updateOrCreate(["descripcion" => "Balance inicial"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Pago"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación pago"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Préstamo"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Cancelación préstamo"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Ajuste capital"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación ajuste capital"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Ajuste caja"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Gasto"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Anulación caja"], ["renglon" => "transaccion"]);
        Tipo::updateOrCreate(["descripcion" => "Transferencia entre cajas"], ["renglon" => "transaccion"]);

        Tipo::updateOrCreate(["descripcion" => "Empleado"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Desempleado"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Estudiante"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Independiente"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Negocio propio"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Pensionado"], ["renglon" => "situacionLaboral"]);
        Tipo::updateOrCreate(["descripcion" => "Otros"], ["renglon" => "situacionLaboral"]);

        Tipo::updateOrCreate(["descripcion" => "Disminuir valor cuota"], ["renglon" => "abonoCapital"]);
        Tipo::updateOrCreate(["descripcion" => "Disminuir plazo"], ["renglon" => "abonoCapital"]);

        Tipo::updateOrCreate(["descripcion" => "Ingresos"], ["renglon" => "contabilidad"]);
        Tipo::updateOrCreate(["descripcion" => "Egresos"], ["renglon" => "contabilidad"]);
    }
}
