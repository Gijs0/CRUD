<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FestivalController extends Controller
{
    public function index(Request $request)
    {
        $query = Festival::query()
            ->where('is_active', true)
            ->where('end_date', '>', now())
            ->orderBy('start_date');

        // Filter by search term
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by month
        if ($request->has('month')) {
            $query->whereMonth('start_date', $request->month);
        }

        // Sort results
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('base_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('base_price', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('start_date', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('start_date', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $festivals = $query->paginate(12);

        return view('festivals.index', compact('festivals'));
    }

    public function show(Festival $festival)
    {
        $relatedFestivals = Festival::where('is_active', true)
            ->where('id', '!=', $festival->id)
            ->where('end_date', '>', now())
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('festivals.show', compact('festival', 'relatedFestivals'));
    }

    public function create()
    {
        $this->authorize('create', Festival::class);
        return view('festivals.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Festival::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'base_price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('festivals', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('festivals/banners', 'public');
        }

        $festival = Festival::create($validated);

        return redirect()
            ->route('festivals.show', $festival)
            ->with('success', 'Festival succesvol aangemaakt.');
    }

    public function edit(Festival $festival)
    {
        $this->authorize('update', $festival);
        return view('festivals.edit', compact('festival'));
    }

    public function update(Request $request, Festival $festival)
    {
        $this->authorize('update', $festival);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'base_price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($festival->image) {
                Storage::disk('public')->delete($festival->image);
            }
            $validated['image'] = $request->file('image')->store('festivals', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($festival->banner_image) {
                Storage::disk('public')->delete($festival->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('festivals/banners', 'public');
        }

        $festival->update($validated);

        return redirect()
            ->route('festivals.show', $festival)
            ->with('success', 'Festival succesvol bijgewerkt.');
    }

    public function destroy(Festival $festival)
    {
        $this->authorize('delete', $festival);

        if ($festival->image) {
            Storage::disk('public')->delete($festival->image);
        }
        if ($festival->banner_image) {
            Storage::disk('public')->delete($festival->banner_image);
        }

        $festival->delete();

        return redirect()
            ->route('festivals.index')
            ->with('success', 'Festival succesvol verwijderd.');
    }

    public function welcome()
    {
        $upcomingFestivals = Festival::where('is_active', true)
            ->where('end_date', '>', now())
            ->orderBy('start_date')
            ->take(6)
            ->get();

        return view('welcome', compact('upcomingFestivals'));
    }
} 