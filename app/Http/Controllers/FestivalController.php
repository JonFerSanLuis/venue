<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival; // Importamos el Modelo

class FestivalController extends Controller
{
    public function index()
    {
        // Buscamos todos los festivales en la base de datos (ordenados por el más nuevo)
        $festivals = Festival::latest()->get();

        // Se los pasamos a la vista
        return view('festivals.index', compact('festivals'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos (que no falte nada y que la foto sea una imagen)
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'style' => 'required|string|max:255',
            'start_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Gestionar la subida de la foto
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('festivals', 'public');
        }

        // 3. Guardar en la Base de Datos
        Festival::create([
            'name' => $request->name,
            'location' => $request->location,
            'style' => $request->style,
            'date' => $request->start_date,
            'image_url' => $imagePath,
        ]);

        // 4. Redirigir al panel con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Festival creado correctamente!');
    }

    // Función para eliminar festivales
    public function destroy($id)
    {
        // 1. Buscamos el festival en la BD
        $festival = Festival::findOrFail($id);

        // 2. (Opcional pero pro) Borramos la foto del disco duro para no ocupar espacio
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($festival->image_url)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($festival->image_url);
        }

        // 3. Borramos el festival de la base de datos
        $festival->delete();

        // 4. Recargamos la página
        return redirect()->route('dashboard')->with('success', '¡Festival eliminado con éxito!');
    }
}