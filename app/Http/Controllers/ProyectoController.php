<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProyectoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $proyectos = Proyecto::paginate();

        return view('modules.proyecto.index', compact('proyectos'))
            ->with('i', ($request->input('page', 1) - 1) * $proyectos->perPage());
        // $rol = Auth::user()->role;

        // if($rol == 1) {
        //     return view('admin.proyecto.index', compact('proyectos'))
        //     ->with('i', ($request->input('page', 1) - 1) * $proyectos->perPage());
        // } elseif ($rol == 2) {
        //     return view('admin.proyecto.index', compact('proyectos'))
        //     ->with('i', ($request->input('page', 1) - 1) * $proyectos->perPage());
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $proyecto = new Proyecto();
        $estatusOptions = ['Activa', 'Cancelado']; // Ejemplo de opciones de estatus

        return view('modules.proyecto.create', compact('proyecto', 'estatusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProyectoRequest $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'codigo_proyecto' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'estatus' => 'required|string|max:255',
            'imagen' => 'nullable|image',

        ]);

        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = $request->file('imagen')->store('imagenes');
        }

        Proyecto::create($validatedData);

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $proyecto = Proyecto::find($id);

        return view('modules.proyecto.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $proyecto = Proyecto::findOrFail($id);
        $estatusOptions = ['Activa', 'Cancelado']; // Ejemplo de opciones de estatus

        return view('modules.proyecto.edit', compact('proyecto', 'estatusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        $validatedData = $request->validate([
            'codigo_proyecto' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'estatus' => 'required|string|max:255',
            'imagen' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = $request->file('imagen')->store('imagenes');
        }

        $proyecto->update($validatedData);

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return Redirect::route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
