<?php

namespace App\Http\Controllers;

use App\Models\ReportesEstante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReportesEstanteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Estante;

class ReportesEstanteController extends Controller
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
        // Cargar la relación 'estante' junto con los datos de reportesEstante
        // $reportesEstantes = ReportesEstante::with('estante')->paginate();

        $codigo_proyecto = $request->input('codigo_proyecto');
        $codigo_partida = $request->input('codigo_partida');
        $accion = $request->input('accion');
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');
        $nombre_estante = $request->input('nombre_estante');

        $query = ReportesEstante::with('estante');

        if ($codigo_proyecto) {
            $query->where('codigo_proyecto', 'LIKE', '%' . $codigo_proyecto . '%');
        }

        if ($codigo_partida) {
            $query->where('codigo_partida', 'LIKE', '%' . $codigo_partida . '%');
        }

        if ($accion) {
            $query->where('accion', $accion);
        }

        if ($fecha_desde && $fecha_hasta) {
            $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } elseif ($fecha_desde) {
            $query->where('fecha', '>=', $fecha_desde);
        } elseif ($fecha_hasta) {
            $query->where('fecha', '<=', $fecha_hasta);
        }

        if ($nombre_estante) {
            $query->whereHas('estante', function($query) use ($nombre_estante) {
                $query->where('nombre', 'LIKE', '%' . $nombre_estante . '%');
            });
        }

        $reportesEstantes = $query->paginate();

        return view('modules.reportes-estante.index', compact('reportesEstantes', 'codigo_proyecto', 'codigo_partida', 'accion', 'fecha_desde', 'fecha_hasta', 'nombre_estante'))
            ->with('i', ($request->input('page', 1) - 1) * $reportesEstantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $estantes = Estante::all();
        $acciones = ['entrada', 'salida'];
        $estatuses = ['conforme', 'no conforme', 'revisar'];

        $reportesEstante = new ReportesEstante();

        return view('modules.reportes-estante.create', compact('reportesEstante', 'estantes', 'acciones', 'estatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportesEstanteRequest $request): RedirectResponse
    {
        ReportesEstante::create($request->validated());

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reportesEstante = ReportesEstante::with('estante')->findOrFail($id);
    
        return view('modules.reportes-estante.show', compact('reportesEstante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reportesEstante = ReportesEstante::find($id);

        $estantes = Estante::all();
        $acciones = ['entrada', 'salida'];
        $estatuses = ['conforme', 'no conforme', 'revisar'];

        return view('modules.reportes-estante.edit', compact('reportesEstante', 'estantes', 'acciones', 'estatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportesEstanteRequest $request, ReportesEstante $reportesEstante): RedirectResponse
    {
        $reportesEstante->update($request->validated());

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        ReportesEstante::find($id)->delete();

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante eliminado exitosamente.');
    }
}
