<?php

namespace App\Http\Controllers;

use App\Models\ReportesEstante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReportesEstanteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReportesEstanteController extends Controller
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
    //     $reportesEstantes = ReportesEstante::paginate();

    //     return view('modules.reportes-estante.index', compact('reportesEstantes'))
    //         ->with('i', ($request->input('page', 1) - 1) * $reportesEstantes->perPage());
    // }

    public function index(Request $request): View
    {
        $codigo_proyecto = $request->input('codigo_proyecto');
        $codigo_partida = $request->input('codigo_partida');
        $accion = $request->input('accion');
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');
        $id_estante = $request->input('id_estante');

        $query = ReportesEstante::query();

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

        if ($id_estante) {
            $query->where('id_estante', $id_estante);
        }

        $reportesEstantes = $query->paginate();

        return view('modules.reportes-estante.index', compact('reportesEstantes', 'codigo_proyecto', 'codigo_partida', 'accion', 'fecha_desde', 'fecha_hasta', 'id_estante'))
            ->with('i', ($request->input('page', 1) - 1) * $reportesEstantes->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reportesEstante = new ReportesEstante();

        return view('modules.reportes-estante.create', compact('reportesEstante'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportesEstanteRequest $request): RedirectResponse
    {
        ReportesEstante::create($request->validated());

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reportesEstante = ReportesEstante::find($id);

        return view('modules.reportes-estante.show', compact('reportesEstante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reportesEstante = ReportesEstante::find($id);

        return view('modules.reportes-estante.edit', compact('reportesEstante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportesEstanteRequest $request, ReportesEstante $reportesEstante): RedirectResponse
    {
        $reportesEstante->update($request->validated());

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ReportesEstante::find($id)->delete();

        return Redirect::route('reportes-estantes.index')
            ->with('success', 'ReportesEstante deleted successfully');
    }
}
