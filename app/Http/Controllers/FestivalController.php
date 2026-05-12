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

    // Muestra el formulario con los datos actuales
    public function edit($id)
    {
        $festival = Festival::findOrFail($id);
        return view('festivals.edit', compact('festival'));
    }

    // Guarda los cambios en la base de datos
    public function update(Request $request, $id)
    {
        $festival = Festival::findOrFail($id);

        // 1. Validamos. La foto NO es required al editar.
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'style' => 'required|string|max:255',
            'start_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Si sube una foto nueva, borramos la vieja y guardamos la nueva
        if ($request->hasFile('image')) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($festival->image_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($festival->image_url);
            }
            $festival->image_url = $request->file('image')->store('festivals', 'public');
        }

        // 3. Actualizamos los campos de texto
        $festival->update([
            'name' => $request->name,
            'location' => $request->location,
            'style' => $request->style,
            'date' => $request->start_date,
            // La imagen se guarda sola por la línea 2 si hubo cambio
        ]);

        // 4. Volvepe al dashboard
        return redirect()->route('dashboard')->with('success', '¡Festival actualizado correctamente!');
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

    // Mostrar la página del cartel
    public function lineup($id)
    {
        // Buscamos el festival y nos traemos también a sus artistas ordenados por hora
        $festival = \App\Models\Festival::with(['artists' => function($query) {
            $query->orderBy('artist_festival.performance_start', 'asc');
        }])->findOrFail($id);

        // Traemos todos los artistas para el desplegable de añadir
        $allArtists = \App\Models\Artist::all();

        return view('festivals.lineup', compact('festival', 'allArtists'));
    }

    // Guardar un artista en el cartel evitando solapamientos
    public function storeLineup(\Illuminate\Http\Request $request, $id)
    {
        $festival = \App\Models\Festival::findOrFail($id);

        $newStart = $request->start_time;
        $newEnd = $request->end_time;

        // Comprobamos si hay algún artista cuyo horario se cruce con el nuevo
        $overlap = $festival->artists()
            ->wherePivot('performance_start', '<', $newEnd)
            ->wherePivot('performance_end', '>', $newStart)
            ->exists();

        if ($overlap) {
            // Si se pisan, devolvemos al usuario a la vista con un mensaje de error
            return back()->withErrors(['time' => 'El horario se solapa con la actuación de otro artista.']);
        }

        // Si no se pisan, lo guardamos
        $festival->artists()->attach($request->artist_id, [
            'performance_start' => $newStart,
            'performance_end' => $newEnd
        ]);

        return back()->with('success', '¡Artista añadido al cartel!');
    }

    // Quitar un artista del cartel
    public function destroyLineup($festival_id, $artist_id)
    {
        $festival = \App\Models\Festival::findOrFail($festival_id);
        // detach() borra la relación en la tabla pivote
        $festival->artists()->detach($artist_id);

        return back()->with('success', 'Actuación eliminada del cartel.');
    }
}