<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Direccion;
use App\Models\Renta;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::with(['direccion', 'rentas'])->get();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|array',
            'direccion.calle' => 'required|string|max:255',
            'direccion.ciudad' => 'required|string|max:255',
            'direccion.estado' => 'required|string|max:255',
            'direccion.pais' => 'required|string|max:255',
            'renta' => 'required|numeric|min:0',
        ]);

        $departamento = Departamento::create([
            'nombre' => $request->input('nombre'),
        ]);

        $departamento->direccion()->create($request->input('direccion'));

        $departamento->rentas()->create([
            'monto' => $request->input('renta'),
        ]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado exitosamente');
    }

    public function show($id)
    {
        $departamento = Departamento::with(['direccion', 'rentas'])->findOrFail($id);
        return view('departamentos.show', compact('departamento'));
    }

    public function edit($id)
    {
        $departamento = Departamento::with(['direccion', 'rentas'])->findOrFail($id);
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|array',
            'direccion.calle' => 'required|string|max:255',
            'direccion.ciudad' => 'required|string|max:255',
            'direccion.estado' => 'required|string|max:255',
            'direccion.pais' => 'required|string|max:255',
            'renta' => 'required|numeric|min:0',
        ]);

        $departamento = Departamento::findOrFail($id);
        $departamento->update($request->only('nombre'));

        $departamento->direccion()->update($request->input('direccion'));

        // Si la renta debe actualizarse de alguna manera específica, puedes hacerlo aquí.
        // Por ejemplo, si solo hay una renta activa por departamento:
        $departamento->rentas()->update(['monto' => $request->input('renta')]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado exitosamente');
    }

    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->direccion()->delete();
        $departamento->rentas()->delete();
        $departamento->delete();
        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado exitosamente');
    }
}
