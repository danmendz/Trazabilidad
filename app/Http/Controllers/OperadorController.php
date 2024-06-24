<?php

namespace App\Http\Controllers;

use App\Models\Operador;
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
    // public function index(Request $request): View
    // {
    //     $operadores = Operador::paginate();

    //     return view('modules.operador.index', compact('operadores'))
    //         ->with('i', ($request->input('page', 1) - 1) * $operadores->perPage());
    // }

    public function index(Request $request): View
{
    $nombre = $request->input('nombre');
    $id_area = $request->input('id_area');

    $query = Operador::query();

    if ($nombre) {
        $query->where('nombre', 'LIKE', '%' . $nombre . '%');
    }

    if ($id_area) {
        $query->where('id_area', $id_area);
    }

    $operadores = $query->paginate();

    return view('modules.operador.index', compact('operadores', 'nombre', 'id_area'))
        ->with('i', ($request->input('page', 1) - 1) * $operadores->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $operadore = new Operador();

        return view('modules.operador.create', compact('operadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OperadorRequest $request): RedirectResponse
    {
        Operador::create($request->validated());

        return Redirect::route('operadores.index')
            ->with('success', 'Operadore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $operadore = Operador::find($id);

        return view('modules.operador.show', compact('operadores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $operadore = Operador::find($id);

        return view('modules.operador.edit', compact('operadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OperadorRequest $request, Operador $operadore): RedirectResponse
    {
        $operadore->update($request->validated());

        return Redirect::route('operadores.index')
            ->with('success', 'Operadore updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Operador::find($id)->delete();

        return Redirect::route('operadores.index')
            ->with('success', 'Operadore deleted successfully');
    }
}
