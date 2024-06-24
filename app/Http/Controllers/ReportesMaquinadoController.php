<?php

namespace App\Http\Controllers;

use App\Models\ReportesMaquinado;
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
    // public function index(Request $request): View
    // {
    //     $reportesMaquinados = ReportesMaquinado::paginate();

    //     return view('modules.reportes-maquinado.index', compact('reportesMaquinados'))
    //         ->with('i', ($request->input('page', 1) - 1) * $reportesMaquinados->perPage());
    // }

    public function index(Request $request): View
    {
        $codigo_proyecto = $request->input('codigo_proyecto');
        $codigo_partida = $request->input('codigo_partida');
        $accion = $request->input('accion');
        $estatus = $request->input('estatus');
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');
        $id_area = $request->input('id_area');

        $query = ReportesMaquinado::query();

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

        if ($id_area) {
            $query->where('id_area', $id_area);
        }

        $reportesMaquinados = $query->paginate();

        return view('modules.reportes-maquinado.index', compact('reportesMaquinados', 'codigo_proyecto', 'codigo_partida', 'accion', 'estatus', 'fecha_desde', 'fecha_hasta', 'id_area'))
            ->with('i', ($request->input('page', 1) - 1) * $reportesMaquinados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reportesMaquinado = new ReportesMaquinado();

        return view('modules.reportes-maquinado.create', compact('reportesMaquinado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportesMaquinadoRequest $request): RedirectResponse
    {
        ReportesMaquinado::create($request->validated());

        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reportesMaquinado = ReportesMaquinado::find($id);

        return view('modules.reportes-maquinado.show', compact('reportesMaquinado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reportesMaquinado = ReportesMaquinado::find($id);

        return view('modules.reportes-maquinado.edit', compact('reportesMaquinado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportesMaquinadoRequest $request, ReportesMaquinado $reportesMaquinado): RedirectResponse
    {
        $reportesMaquinado->update($request->validated());

        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ReportesMaquinado::find($id)->delete();

        return Redirect::route('reportes-maquinados.index')
            ->with('success', 'ReportesMaquinado deleted successfully');
    }
}
