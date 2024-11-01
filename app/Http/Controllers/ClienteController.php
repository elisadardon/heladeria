<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', [
            'clientes' => $clientes
        ]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $this->validate($request, [
                'nombre' => 'required|max:100',
                'correo' => 'required|max:100|email',
                'telefono' => 'required|max:15',
            ]);

            Cliente::create([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
            ]);
            
            DB::commit();

            session()->flash('success', 'Registro creado correctamente');
            return to_route('clientes.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo crear el registro: ' . $th->getMessage());
        }
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', [
            'cliente' => $cliente
        ]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        DB::beginTransaction();

        try {

            $this->validate($request, [
                'nombre' => 'required|max:100',
                'correo' => 'required|max:100|email|unique:clientes,correo,' . $cliente->id,
                'telefono' => 'required|max:15',
            ]);

            $cliente->update([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
            ]);
            
            DB::commit();

            session()->flash('success', 'Registro actualizado correctamente');
            return to_route('clientes.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo actualizar el registro: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            Cliente::destroy($id);

            DB::commit();

            session()->flash('success', 'Registro eliminado correctamente');
            return to_route('clientes.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo eliminar el registro: ' . $th->getMessage());
        }
    }
}
