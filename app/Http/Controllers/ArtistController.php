<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::latest()->get();
        return view('artists.index', compact('artists'));
    }

    public function show($id)
    {
        $artist = Artist::with('festivals')->findOrFail($id);
        return view('artists.show', compact('artist'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'genre'       => 'nullable|string|max:255',
            'country'     => 'nullable|string|max:255',
            'bio'         => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'spotify_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('artists', 'public');
        }

        Artist::create([
            'name'        => $request->name,
            'genre'       => $request->genre,
            'country'     => $request->country,
            'bio'         => $request->bio,
            'image_url'   => $imagePath,
            'spotify_url' => $request->spotify_url,
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Artista añadido correctamente!');
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'genre'       => 'nullable|string|max:255',
            'country'     => 'nullable|string|max:255',
            'bio'         => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'spotify_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($artist->image_url && Storage::disk('public')->exists($artist->image_url)) {
                Storage::disk('public')->delete($artist->image_url);
            }
            $artist->image_url = $request->file('image')->store('artists', 'public');
        }

        $artist->update([
            'name'        => $request->name,
            'genre'       => $request->genre,
            'country'     => $request->country,
            'bio'         => $request->bio,
            'spotify_url' => $request->spotify_url,
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Artista actualizado correctamente!');
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);

        if ($artist->image_url && Storage::disk('public')->exists($artist->image_url)) {
            Storage::disk('public')->delete($artist->image_url);
        }

        $artist->delete();

        return redirect()->route('dashboard')->with('success', 'Artista eliminado correctamente.');
    }
}