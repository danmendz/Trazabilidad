<?php

namespace App\Http\Controllers;

use App\Models\ReportesMaquinado;
use App\Models\Area;
use App\Models\Maquina;
use App\Models\Operador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReportesMaquinadoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReportesMaquinadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:acceder-admin-ventas')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $reportesMaquinados = ReportesMaquinado::with('area', 'maquina', 'operador')->paginate();

        $codigo_proyecto = $request->input('codigo_proyecto');
        $codigo_partida = $request->input('codigo_partida');
        $accion = $request->input('accion');
        $estatus = $request->input('estatus');
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');
        $nombre_area = $request->input('nombre_area');

        $query = ReportesMaquinado::with('area', 'maquina', 'operador');

        if ($codigo_proyecto) {
            $query->where('codigo_proyecto', 'LIKE', '%' . $codigo_proyecto . '%');
        }

        if ($codigo_partida) {
            $query->where('codigo_partida', 'LIKE', '%' . $codigo_partida . '%');
        }

        if ($accion) {
            $query->where('accion', $accion);
        }

        if ($estatus) {
            $query->where('estatus', $estatus);
        }

        if ($fecha_desde && $fecha_hasta) {
            $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } elseif ($fecha_desde) {
            $query->where('fecha', '>=', $fecha_desde);
        } elseif ($fecha_hasta) {
            $query->where('fecha', '<=', $fecha_hasta);
        }

        if ($nombre_area) {
            $query->whereHas('area', function($query) use ($nombre_area) {
                $query->where('nombre', 'LIKE', '%' . $nombre_area . '%');
            });
        }

        $reportesMaquinados = $query->paginate();

        return view('modules.reportes-maquinado.index', compact('reportesMaquinados', 'codigo_proyecto', 'codigo_partida', 'accion', 'estatus', 'fecha_desde', 'fecha_hasta', 'nombre_area'))
        ->with('i', ($request->input('page', 1) - 1) * $reportesMaquinados->perPage());
    }

    public function registrosPorRevisar(Request $request)
    {
        $query = ReportesMaquinado::with('area', 'maquina', 'operador')->where('estatus', 'revisar');
        $reportesPorRevisar = $query->paginate();

        return view('admin.index', compact('reportesPorRevisar'))
        ->with('i', ($request->input('page', 1) - 1) * $reportesPorRevisar->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $areas = Area::all();
        $maquinas = Maquina::all();
        $operadores = Operador::all();
        
        // Definir las listas de valores para Turno, Acción y Estatus
        $turnos = ['primero', 'segundo'];
        $acciones = ['entrada', 'turno terminado', 'pieza terminada'];
        $estatuses = ['proceso', 'finalizado', 'revisar'];
    
        $reportesMaquinado = new ReportesMaquinado();
    
        return view('modules.reportes-maquinado.create', compact('reportesMaquinado', 'areas', 'maquinas', 'operadores', 'turnos', 'acciones', 'estatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportesMaquinadoRequest $request): RedirectResponse
    {
        ReportesMaquinado::create($request->validated());
    
        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reportesMaquinado = ReportesMaquinado::with('area', 'maquina', 'operador')->findOrFail($id);

        return view('modules.reportes-maquinado.show', compact('reportesMaquinado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reportesMaquinado = ReportesMaquinado::find($id);
    
        $areas = Area::all();
        $maquinas = Maquina::all();
        $operadores = Operador::all();
        
        // Definir las listas de valores para Turno, Acción y Estatus
        $turnos = ['primero', 'segundo'];
        $acciones = ['entrada', 'turno terminado', 'pieza terminada'];
        $estatuses = ['proceso', 'finalizado', 'revisar'];
    
        return view('modules.reportes-maquinado.edit', compact('reportesMaquinado', 'areas', 'maquinas', 'operadores', 'turnos', 'acciones', 'estatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportesMaquinadoRequest $request, ReportesMaquinado $reportesMaquinado): RedirectResponse
    {
        $reportesMaquinado->update($request->validated());
    
        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        ReportesMaquinado::find($id)->delete();

        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado eliminado exitosamente.');
    }
}
