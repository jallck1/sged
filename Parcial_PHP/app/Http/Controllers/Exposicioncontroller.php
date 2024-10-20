<?php

namespace App\Http\Controllers;

use App\Models\Exposicion; // Importa el modelo Exposicion
use App\Models\ObraArte;   // Importa el modelo ObraArte si lo necesitas
use Illuminate\Http\Request;

class ExposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Asegúrate de que el modelo Exposicion tenga la relación 'obraArte' definida correctamente
        $exposiciones = Exposicion::with('obraArte')->get(); // Carga la obra de arte asociada
        return view('exposiciones.index', compact('exposiciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí solo muestra el formulario para crear una nueva exposición
        $obrasArte = ObraArte::all(); // Si necesitas pasar las obras de arte al formulario
        return view('exposiciones.create', compact('obrasArte'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos y guarda la nueva exposición
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'ubicacion' => 'required',
            'nombre_evento' => 'required',
            'obra_arte_id' => 'required|exists:obra_artes,id', // Verifica que la obra de arte exista
        ]);
    
        Exposicion::create($request->all()); // Guarda la exposición
    
        return redirect()->route('exposiciones.index')->with('success', 'Exposición creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
