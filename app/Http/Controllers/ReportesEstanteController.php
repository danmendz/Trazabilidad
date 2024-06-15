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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $reportesEstantes = ReportesEstante::paginate();

        return view('modules.reportes-estante.index', compact('reportesEstantes'))
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
