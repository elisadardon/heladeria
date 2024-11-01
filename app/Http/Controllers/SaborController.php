<?php

namespace App\Http\Controllers;

use App\Models\Sabor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaborController extends Controller
{
    public function index()
    {
        $sabores = Sabor::all();

        return view('sabores.index', [
            'sabores' => $sabores
        ]);
    }

    public function create()
    {
        return view('sabores.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $this->validate($request, [
                'nombre' => 'required|max:50',
                'descripcion' => 'required|max:255',
                'precio' => 'required|numeric',
            ]);

            Sabor::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
            
            DB::commit();

            session()->flash('success', 'Registro creado correctamente');
            return to_route('sabores.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo crear el registro: ' . $th->getMessage());
        }
    }

    public function edit(Sabor $sabor)
    {
        return view('sabores.edit', [
            'sabor' => $sabor
        ]);
    }

    public function update(Request $request, Sabor $sabor)
    {
        DB::beginTransaction();

        try {

            $this->validate($request, [
                'nombre' => 'required|max:50',
                'descripcion' => 'required|max:255',
                'precio' => 'required|numeric',
            ]);

            $sabor->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
            
            DB::commit();

            session()->flash('success', 'Registro actualizado correctamente');
            return to_route('sabores.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo actualizar el registro: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            Sabor::destroy($id);

            DB::commit();

            session()->flash('success', 'Registro eliminado correctamente');
            return to_route('sabores.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'No se pudo eliminar el registro: ' . $th->getMessage());
        }
    }
}
