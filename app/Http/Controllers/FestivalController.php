<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\Location;
use App\Models\TicketType;

class FestivalController extends Controller
{
    public function index()
    {
        $festivals = Festival::with(['artists', 'ticketTypes', 'location'])->latest()->get();
        return view('festivals.index', compact('festivals'));
    }

    public function show($id)
    {
        $festival = Festival::with([
            'artists' => function($query) {
                $query->orderBy('artist_festival.performance_start', 'asc');
            },
            'ticketTypes',
            'location'
        ])->findOrFail($id);

        return view('festivals.show', compact('festival'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'style'               => 'required|string|max:255',
            'start_date'          => 'required|date',
            'image'               => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ticket_names.*'      => 'required|string|max:255',
            'ticket_prices.*'     => 'required|numeric|min:0',
            'ticket_quantities.*' => 'required|integer|min:1',
        ]);

        $imagePath = $request->file('image')->store('festivals', 'public');

        $festival = Festival::create([
            'name'        => $request->name,
            'location'    => $request->location_id ? Location::find($request->location_id)->city : '',
            'location_id' => $request->location_id ?: null,
            'style'       => $request->style,
            'date'        => $request->start_date,
            'image_url'   => $imagePath,
        ]);

        if ($request->ticket_names) {
            foreach ($request->ticket_names as $i => $name) {
                $festival->ticketTypes()->create([
                    'name'     => $name,
                    'price'    => $request->ticket_prices[$i],
                    'quantity' => $request->ticket_quantities[$i],
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', '¡Festival creado correctamente!');
    }

    public function edit($id)
    {
        $festival  = Festival::with('ticketTypes')->findOrFail($id);
        $locations = Location::orderBy('name')->get();
        return view('festivals.edit', compact('festival', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $festival = Festival::findOrFail($id);

        $request->validate([
            'name'                => 'required|string|max:255',
            'style'               => 'required|string|max:255',
            'start_date'          => 'required|date',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ticket_names.*'      => 'required|string|max:255',
            'ticket_prices.*'     => 'required|numeric|min:0',
            'ticket_quantities.*' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($festival->image_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($festival->image_url);
            }
            $festival->image_url = $request->file('image')->store('festivals', 'public');
        }

        $festival->update([
            'name'        => $request->name,
            'location'    => $request->location_id ? Location::find($request->location_id)->city : $festival->location,
            'location_id' => $request->location_id ?: null,
            'style'       => $request->style,
            'date'        => $request->start_date,
        ]);

        $festival->ticketTypes()->delete();
        if ($request->ticket_names) {
            foreach ($request->ticket_names as $i => $name) {
                $festival->ticketTypes()->create([
                    'name'     => $name,
                    'price'    => $request->ticket_prices[$i],
                    'quantity' => $request->ticket_quantities[$i],
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', '¡Festival actualizado correctamente!');
    }

    public function destroy($id)
    {
        $festival = Festival::findOrFail($id);

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($festival->image_url)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($festival->image_url);
        }

        $festival->delete();

        return redirect()->route('dashboard')->with('success', '¡Festival eliminado con éxito!');
    }

    public function lineup($id)
    {
        $festival = Festival::with(['artists' => function($query) {
            $query->orderBy('artist_festival.performance_start', 'asc');
        }])->findOrFail($id);

        $allArtists = \App\Models\Artist::all();

        return view('festivals.lineup', compact('festival', 'allArtists'));
    }

    public function storeLineup(Request $request, $id)
    {
        $festival = Festival::findOrFail($id);

        $overlap = $festival->artists()
            ->wherePivot('performance_start', '<', $request->end_time)
            ->wherePivot('performance_end', '>', $request->start_time)
            ->exists();

        if ($overlap) {
            return back()->withErrors(['time' => 'El horario se solapa con la actuación de otro artista.']);
        }

        $festival->artists()->attach($request->artist_id, [
            'performance_start' => $request->start_time,
            'performance_end'   => $request->end_time,
        ]);

        return back()->with('success', '¡Artista añadido al cartel!');
    }

    public function destroyLineup($festival_id, $artist_id)
    {
        $festival = Festival::findOrFail($festival_id);
        $festival->artists()->detach($artist_id);
        return back()->with('success', 'Actuación eliminada del cartel.');
    }
}