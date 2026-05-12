<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    // Mostrar formulario de crear
    public function create()
    {
        return view('artists.create');
    }

    // Guardar en la base de datos
    public function store(Request $request)
    {
        // 1. Validamos los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Subimos la foto si hay una
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('artists', 'public');
        }

        // 3. Creamos el registro
        Artist::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'country' => $request->country,
            'image_url' => $imagePath,
        ]);

        // 4. Volvemos al Dashboard
        return redirect()->route('dashboard')->with('success', '¡Artista añadido correctamente!');
    }

    // Mostrar el formulario lleno con los datos del artista
    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('artists.edit', compact('artist'));
    }

    // Guardar los cambios
    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Borramos la foto vieja si existe
            if ($artist->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($artist->image_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($artist->image_url);
            }
            $artist->image_url = $request->file('image')->store('artists', 'public');
        }

        $artist->update([
            'name' => $request->name,
            'genre' => $request->genre,
            'country' => $request->country,
            // La imagen ya se actualiza arriba si se subió una nueva
        ]);

        return redirect()->route('dashboard')->with('success', '¡Artista actualizado correctamente!');
    }

    // Eliminar artista
    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);

        // Borramos la foto del disco duro para no gastar espacio
        if ($artist->image_url && Storage::disk('public')->exists($artist->image_url)) {
            Storage::disk('public')->delete($artist->image_url);
        }

        $artist->delete();

        return redirect()->route('dashboard')->with('success', 'Artista eliminado correctamente.');
    }
}