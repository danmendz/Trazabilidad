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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Cargar la relación 'estante' junto con los datos de reportesEstante
        $reportesEstantes = ReportesEstante::with('estante')->paginate();
    
        return view('modules.reportes-estante.index', compact('reportesEstantes'))
            ->with('i', ($request->input('page', 1) - 1) * $reportesEstantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $estantes = Estante::all();
        $acciones = ['Entrada', 'Salida'];
        $estatuses = ['Conforme', 'No conforme'];

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
        $acciones = ['Entrada', 'Salida'];
        $estatuses = ['Conforme', 'No conforme'];

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
