<?php

namespace App\Http\Controllers;

use App\Models\Operador;
use App\Models\Area;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OperadorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $operadores = Operador::with('area')->paginate();
        $nombre = $request->input('nombre');
        $nombre_area = $request->input('nombre_area');

        $query = Operador::with('area');

        if ($nombre) {
            $query->where('nombre', 'LIKE', '%' . $nombre . '%');
        }

        if ($nombre_area) {
            $query->whereHas('area', function($query) use ($nombre_area) {
                $query->where('nombre', 'LIKE', '%' . $nombre_area . '%');
            });
        }
    
        $operadores = $query->paginate();
    
        return view('modules.operador.index', compact('operadores', 'nombre', 'nombre_area'))
            ->with('i', ($request->input('page', 1) - 1) * $operadores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $operador = new Operador();
        $areas = Area::all(); // Obtener todas las áreas


        return view('modules.operador.create', compact('operador', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OperadorRequest $request): RedirectResponse
    {
        Operador::create($request->validated());

        return Redirect::route('operadores.index')
            ->with('success', 'Operador creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $operador = Operador::find($id);
        $area = Area::find($operador->id_area);

        return view('modules.operador.show', compact('operador', 'area'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $operador = Operador::find($id);
        $areas = Area::all(); // Obtener todas las áreas

        return view('modules.operador.edit', compact('operador', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OperadorRequest $request, Operador $operador): RedirectResponse
    {
        $operador->update($request->validated());

        return Redirect::route('operadores.index')
            ->with('success', 'Operador actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Operador::find($id)->delete();

        return Redirect::route('operadores.index')
            ->with('success', 'Operador eliminado exitosamente.');
    }
}
