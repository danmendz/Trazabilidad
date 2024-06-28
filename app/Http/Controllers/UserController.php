<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReportesEstante;
use App\Models\ReportesMaquinado;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ReportesMaquinadoController;
use Illuminate\View\View;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $role = $request->input('role');
        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->paginate();

        return view('admin.user.index', compact('users', 'role'))
            ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
    }

    public function operador()
    {
        return view('operador.index');
    }

    public function ventas()
    {
        return view('ventas.index');
    }

    public function admin()
    {
        $salidasEstante = ReportesEstante::where('accion', 'salida')->count();
        $salidasMaquinado = ReportesMaquinado::where(function($query) {
            $query->where('accion', 'turno terminado')
                ->orWhere('accion', 'pieza terminada');
        })->count();
        $revisarEstante = ReportesEstante::where('estatus', 'revisar')->count();
        $revisarMaquinado = ReportesMaquinado::where('estatus', 'revisar')->count();
        $revisarRegistros = $revisarEstante + $revisarMaquinado;

        $numeroProyectos = Proyecto::count();

        return view('admin.index', compact('numeroProyectos', 'salidasEstante', 'salidasMaquinado', 'revisarRegistros'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();
        $roles = $this->getRoles(); // Obtener los roles

        return view('admin.user.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Usar 'role'
        ]);

        return Redirect::route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('admin.user.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = $this->getRoles(); // Obtener los roles

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role, // Usar 'role'
        ]);

        return Redirect::route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        return Redirect::route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Get the roles for the user.
     */
    private function getRoles()
    {
        return [
            User::ROLE_ADMINISTRADOR => 'Administrador',
            User::ROLE_VENTAS => 'Ventas',
            User::ROLE_OPERADOR => 'Operador',
        ];
    }
}
