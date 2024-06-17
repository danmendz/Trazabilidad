<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MaquinaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $maquinas = Maquina::paginate();

        return view('modules.maquina.index', compact('maquinas'))
            ->with('i', ($request->input('page', 1) - 1) * $maquinas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $maquina = new Maquina();

        return view('modules.maquina.create', compact('maquina'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaquinaRequest $request): RedirectResponse
    {
        Maquina::create($request->validated());

        return Redirect::route('maquinas.index')
            ->with('success', 'Máquina creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $maquina = Maquina::find($id);

        return view('modules.maquina.show', compact('maquina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $maquina = Maquina::find($id);

        return view('modules.maquina.edit', compact('maquina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaquinaRequest $request, Maquina $maquina): RedirectResponse
    {
        $maquina->update($request->validated());

        return Redirect::route('maquinas.index')
            ->with('success', 'Máquina actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Maquina::find($id)->delete();

        return Redirect::route('maquinas.index')
            ->with('success', 'Máquina eliminado exitosamente.');
    }
}
