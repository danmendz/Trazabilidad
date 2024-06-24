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
    public function __construct()
    {
        $this->middleware('can:acceder-admin-ventas')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $codigo_proyecto = $request->input('codigo_proyecto');
        $empresa = $request->input('empresa');
        $estatus = $request->input('estatus');
    
        $query = Proyecto::query();

        if ($codigo_proyecto) {
            $query->where('codigo_proyecto', 'LIKE', '%' . $codigo_proyecto . '%');
        }
    
        if ($empresa) {
            $query->where('empresa', 'LIKE', '%' . $empresa . '%');
        }
    
        if ($estatus) {
            $query->where('estatus', $estatus);
        }
    
        $proyectos = $query->paginate();
    
        return view('modules.proyecto.index', compact('proyectos', 'codigo_proyecto', 'empresa', 'estatus'))
            ->with('i', ($request->input('page', 1) - 1) * $proyectos->perPage());
    }

    public function numeroDeProyectos()
    {
        $numeroProyectos = Proyecto::count();
        return view('admin.index', compact('numeroProyectos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $proyecto = new Proyecto();
        $estatusOptions = ['Activo', 'Cancelado']; // Ejemplo de opciones de estatus

        return view('modules.proyecto.create', compact('proyecto', 'estatusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProyectoRequest $request): RedirectResponse
    {
        Proyecto::create($request->validated());
        $request->validate([
            'codigo_proyecto' => 'required', 
            'empresa' => 'required', 
            'estatus' => 'required', 
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($imagen = $request->file('imagen')) {
            $destinationPath = 'images/projects';
            $profileImage = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($destinationPath, $profileImage);
            $input['imagen'] = "$profileImage";
        }

        Proyecto::create($input);

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
        $estatusOptions = ['Activo', 'Cancelado']; // Ejemplo de opciones de estatus

        return view('modules.proyecto.edit', compact('proyecto', 'estatusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        $request->validate([
            'codigo_proyecto' => 'required', 
            'empresa' => 'required', 
            'estatus' => 'required', 
        ]);

        $input = $request->all();

        if ($imagen = $request->file('imagen')) {
            $destinationPath = 'images/projects';
            $profileImage = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($destinationPath, $profileImage);
            $input['imagen'] = "$profileImage";
        } else{
            unset($input['imagen']);
        }

        $proyecto->update($input);

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
