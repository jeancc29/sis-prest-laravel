<?php

namespace App\Http\Controllers;

use App\Models\Cierre;
use App\Http\Requests\StoreCierreRequest;
use App\Http\Requests\UpdateCierreRequest;

class CierreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = request()->validate([
            'data.id' => '',
            'data.usuario' => '',
            'data.apiKey' => '',
            'data.idEmpresa' => '',
            'data.fechaDesde' => '',
            'data.fechaHasta' => '',
            'data.idCaja' => '',
        ])["data"];

        \App\Classes\Helper::validateApiKey($datos["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos, "Cajas", ["Ver cierres"]);

        $idCaja = $datos["idCaja"] ?? null;
        $fechaDesde = $datos["fechaDesde"] ?? null;
        $fechaHasta = $datos["fechaHasta"] ?? null;
        $fechaDesde = $fechaDesde != null ? new Carbon($fechaDesde) : null;
        $fechaHasta = $fechaHasta != null ? new Carbon($fechaHasta) : null;

        $usuario = \App\User::whereId($datos["id"])->first();
        $cajas = $usuario->cajas;

        //Si el usuario tiene cajas pues obtenemos nuevamente esas cajas pero con sus respectivos transacciones
        //de lo contrario pues buscamos todas las cajas de la empresa y las retornamos todas pero solo la primera caja
        //va a tener sus transacciones
        if(count($cajas) > 0){
            $idCajas = $cajas->map(function($d){
                $d->id;
            });
            $cajas = Box::customAll($idCajas);
        }else{
            $cajas = Box::where("descripcion", '!=', "Ninguna")->where("idEmpresa", $datos["idEmpresa"])->get();
            if(count($cajas) > 0){
                $cajas[0]->transacciones = Box::transacciones($cajas[0]->id);
                $cajas[0]->cierres = Box::cierres($cajas[0]->id);
            }
        }

        $transacciones = TransactionResource::collection(Transaction::whereStatus(1)
            ->with("box", "type", "user", "incomeOrExpenseType")
            ->when($idCaja != null, function($q) use($idCaja){ $q->where("idCaja", $idCaja); })
            ->when($fechaDesde != null, function($q) use($fechaDesde, $fechaHasta){$q->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"]);})
            ->orderBy("created_at", "desc")
            ->get());

        $cierres = ClosureResource::collection(Closure::whereStatus(1)
            ->with("box", "user")
            ->when($idCaja != null, function($q) use($idCaja){ $q->where("idCaja", $idCaja); })
            ->when($fechaDesde != null, function($q) use($fechaDesde, $fechaHasta){$q->whereBetween("created_at", [$fechaDesde->toDateString() . " 00:00", $fechaHasta->toDateString() . " 23:59:59"]);})
            ->orderBy("created_at", "desc")
            ->get());

//        $cierres = Closure::


        return Response::json([
            "mensaje" => "",
            "cajas" => $cajas,
            "transacciones" => $transacciones,
            "cierres" => $cierres,
            "balance" => $transacciones->sum(function($d){return $d->incomeOrExpenseType->descripcion == "Egresos" ? -1 * $d->monto : $d->monto;})
//            "balance" => $transacciones->sum("monto")
        ], 201);
    }

    public function getBoxDataToClose(){
        $datos = request()->validate([
            'data.id' => '',
            'data.usuario' => '',
            'data.apiKey' => '',
            'data.idEmpresa' => '',
            'data.idCaja' => '',
        ])["data"];

        \App\Classes\Helper::validateApiKey($datos["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos, "Cajas", ["Ver cierres"]);

        $idCaja = $datos["idCaja"] ?? null;
        $caja = $idCaja != null ? Box::query()->find($idCaja) : null;

        $transacciones = Transaction::query()
            ->selectRaw("t.id, t.descripcion, sum(transactions.monto) total, transactions.idTipoIngresoEgreso")
            ->join("types as t", "t.id", "=", "transactions.idTipoPago")
            ->where(["transactions.idCaja" => $idCaja, "transactions.status" => 1])
            ->groupBy("transactions.idTipoIngresoEgreso", "t.id")
            ->orderBy("transactions.idTipoIngresoEgreso")
            ->orderBy("t.id")
            ->get();



        // Buscamos el index EFECTIVO


        $tiposIngresosYEgresos = Type::query()
            ->whereRenglon("contabilidad")
            ->orderBy("id")->get();

        $tiposIngresosEgresosConSusTransacciones = $tiposIngresosYEgresos->map(function($d) use($transacciones){
            $ingresosYEgresos = $transacciones->filter(function($f) use($d){return $f->idTipoIngresoEgreso == $d->id;})->values();

            //Como el EFECTIVO y el EFECTIVO EN RUTA son lo mismo, pues le vamos a sumar el total de EFECTIVO EN RUTA al EFECTIVO
            // y eliminaremos el EFECTIVO EN RUTA

            // Objeto efectivo en ruta
            $tipoEfectivoEnRuta = $ingresosYEgresos->first(function($item){ return $item->descripcion == "Efectivo en ruta"; });
            $isnull = $tipoEfectivoEnRuta == null;
//            $stringTipos = $ingresosYEgresos->map(function($t){ return $t->descripcion . ", "; });
//            if($d->descripcion == "Egresos")
//                throw new \Exception("Hey is null $stringTipos: " . $isnull);
            if($tipoEfectivoEnRuta != null){
                $indexTipoEfectivo = $ingresosYEgresos->search(function($item) {
                    return $item->descripcion == "Efectivo";
                });



                if(is_numeric($indexTipoEfectivo)){
//                    throw new \Exception("Hey is null: " . $indexTipoEfectivo);
                    // Sumamos el total al EFECTIVO
                    $ingresosYEgresos[$indexTipoEfectivo]->total += $tipoEfectivoEnRuta->total;

                    // eliminaremos el EFECTIVO EN RUTA
                    $indexTipoEfectivoEnRuta = $ingresosYEgresos->search(function($item) {
                        return $item->descripcion == "Efectivo en ruta";
                    });
                    $ingresosYEgresos->forget($indexTipoEfectivoEnRuta);
                }
            }



            $total = $ingresosYEgresos->sum("total");
            return ["id" => $d->id, "descripcion" => $d->descripcion, "tiposPagos" => $ingresosYEgresos, "total" => $total];
        })->values();

        return Response::json([
            "mensaje" => "",
            "tiposIngresosEgresosConSusTransacciones" => $tiposIngresosEgresosConSusTransacciones,
            "caja" => $caja
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCierreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCierreRequest $request)
    {
        $datos = request()->validate([
            'data.usuario' => '',
            'data.caja' => '',
            'data.montoEfectivo' => '',
            'data.montoCheques' => '',
            'data.montoTarjetas' => '',
            'data.montoTransferencias' => '',
            'data.comentario' => '',
        ])["data"];

        /// VALIDATE apiKEY AND permissions
        \App\Classes\Helper::validateApiKey($datos["usuario"]["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos["usuario"], "Cajas", ["Realizar cierres"]);

        /// VALIDATE BOX
        $caja = Box::whereId($datos["caja"]["id"])->first();
        if($caja == null)
            abort(404, "La caja no existe");

        if($caja->balance == null)
            abort(404, "La caja no ha sido abierta");

        //VALIDATE TRANSACTIONS
        $transaccionesSinCerrar = $caja->transactions()->whereStatus(1)->get();
        if(count($transaccionesSinCerrar) == 0)
            abort(404, "La caja no tiene transacciones");

        $totalPagado = round($datos["montoEfectivo"] + $datos["montoCheques"] + $datos["montoTransferencias"], 2);

        /// CREATE CLOSURE AND SAVE HIS TRANSACTIONS
        $cierre = \App\Closure::create([
            "idUsuario" => $datos["usuario"]["id"],
            "idEmpresa" => $datos["usuario"]["idEmpresa"],
            "idCaja" => $caja->id,
            "totalSegunUsuario" => $totalPagado,
            "totalSegunSistema" => $caja->balance,
            "comentario" => $datos["comentario"],
            "montoEfectivo" => $datos["montoEfectivo"],
            "montoCheques" => $datos["montoCheques"],
            "montoTarjetas" => 0,
            "montoTransferencias" => $datos["montoTransferencias"],
            "diferencia" => round($totalPagado - $caja->balance, 2),
        ]);


        $transaccionesToSave = $transaccionesSinCerrar->map(function($d) use($cierre){
            return ["idTransaccion" => $d->id, "idCierre" => $cierre->id];
        });
        $cierre->transactions()->attach($transaccionesToSave);

        ///CHANGE STATUS OF TRANSACTIONS TO CERRADA
        $caja->transactions()->whereStatus(1)->update(["status" => 2]);

        /// MAKE AUTOMATIC TRANSACTIONS Balance Inciial
//        $tipo = \App\Type::where(["renglon" => "transaccion", "descripcion" => "Balance inicial"])->first();
//        \App\Transaction::make($datos["usuario"], $caja, $caja->balanceInicial, $tipo, $caja->id, $datos["comentario"]);

        //SET NEW BALANCE TO BOX
        $caja->balance = null;
        $caja->balanceInicial = null;
        $caja->save();
        $cierre->usuario = $datos["usuario"];
        $caja->fresh();

        return Response::json([
            "message" => "La caja se ha cerrado correctamente",
            "transacciones" => Box::transacciones($caja->id),
            "data" => $cierre,
            "caja" => $caja
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function show(Cierre $cierre)
    {
        $datos = request()->validate([
            'data.usuario' => '',
            'data.cierre' => '',
        ])["data"];

        /// VALIDATE apiKEY AND permissions
        \App\Classes\Helper::validateApiKey($datos["usuario"]["apiKey"]);
        \App\Classes\Helper::validatePermissions($datos["usuario"], "Cajas", ["Ver cierres"]);

        return Response::json([
            "message" => "La caja se ha cerrado correctamente",
            "transacciones" => \App\Closure::transacciones($datos["cierre"]["id"]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function edit(Cierre $cierre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCierreRequest  $request
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCierreRequest $request, Cierre $cierre)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cierre  $cierre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cierre $cierre)
    {
        //
    }
}
