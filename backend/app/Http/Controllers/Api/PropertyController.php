<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display properties with filters and pagination.
     */
    public function index(Request $request)
    {
        $query = Property::query();

        // Filter by area
        if ($request->filled('area')) {
            $query->where('area', 'like', '%' . $request->area . '%');
        }

        // Filter by minimum price and by maximum price
       if ($request->filled('min')) {
        $query->where('price_per_night', '>=', $request->min);
        }
        if ($request->filled('max')) {
            $query->where('price_per_night', '<=', $request->max);
        }
        // Filter by number of bedrooms
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        $perPage = min(
            max((int) $request->input('per_page', 10), 1),
            50
        );

        $properties = $query
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $properties->items(),
            'meta' => [
                'current_page' => $properties->currentPage(),
                'last_page' => $properties->lastPage(),
                'per_page' => $properties->perPage(),
                'total' => $properties->total(),
            ],
        ]);
    }

    /**
     * Store a new property.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'price_per_night' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:1',
            'is_available' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $property = Property::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Property created successfully.',
            'data' => $property,
        ], 201);
    }

    /**
     * Display a single property.
     */
    public function show(Property $property)
    {
        return response()->json([
            'success' => true,
            'data' => $property,
        ]);
    }

    /**
     * Update an existing property.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'area' => 'sometimes|required|string|max:255',
            'price_per_night' => 'sometimes|required|integer|min:0',
            'bedrooms' => 'sometimes|required|integer|min:1',
            'is_available' => 'sometimes|required|boolean',
            'description' => 'sometimes|nullable|string',
        ]);

        $property->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Property updated successfully.',
            'data' => $property->fresh(),
        ]);
    }

    /**
     * Delete a property.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            'success' => true,
            'message' => 'Property deleted successfully.',
        ]);
    }
}
