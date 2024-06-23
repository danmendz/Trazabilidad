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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reportesMaquinados = ReportesMaquinado::with('area', 'maquina', 'operador')->paginate();

        return view('modules.reportes-maquinado.index', compact('reportesMaquinados'))
            ->with('i', ($request->input('page', 1) - 1) * $reportesMaquinados->perPage());
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
        $turnos = ['Primero', 'Segundo'];
        $acciones = ['Entrada', 'Turno terminado', 'Pieza terminada'];
        $estatuses = ['Proceso', 'Finalizado', 'Revisar'];
    
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
        $turnos = ['Primero', 'Segundo'];
        $acciones = ['Entrada', 'Turno terminado', 'Pieza terminada'];
        $estatuses = ['Proceso', 'Finalizado', 'Revisar'];
    
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
