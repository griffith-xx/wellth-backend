<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Province;
use Inertia\Inertia;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::with('province')->get();

        return Inertia::render('Destinations/Index', [
            'destinations' => $destinations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::get();

        return Inertia::render('Destinations/Create', [
            'provinces' => $provinces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'description' => 'required|string',
            'image_url' => 'required|string',
            'gallery_images' => 'nullable|string',
            'suitable_health_goals' => 'nullable|array',
            'suitable_health_conditions' => 'nullable|array',
            'activity_level' => 'nullable|string',
            'spa_treatments_available' => 'nullable|array',
            'traditional_healing_available' => 'nullable|array',
            'fitness_programs_available' => 'nullable|array',
            'accommodation_types' => 'nullable|array',
            'price_range' => 'nullable|string',
            'suitable_trip_duration' => 'nullable|string',
            'suitable_travel_style' => 'nullable|string',
            'nature_types' => 'nullable|array',
            'climate_type' => 'nullable|string',
            'best_months' => 'nullable|array',
            'dietary_options_available' => 'nullable|array',
            'food_restrictions_supported' => 'nullable|array',
            'accessibility_features' => 'nullable|array',
            'languages_supported' => 'nullable|array',
            'medical_support_available' => 'nullable|string|in:required,not_required',
            'social_environment' => 'nullable|array',
        ]);

        if (!empty($validated['gallery_images'])) {
            $validated['gallery_images'] = array_map('trim', explode(',', $validated['gallery_images']));
        } else {
            $validated['gallery_images'] = [];
        }

        Destination::create($validated);

        return redirect()->route('destinations.index')->with('flash', [
            'message' => 'Destinations created successfully.',
            'style' => 'success',
        ]);
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
