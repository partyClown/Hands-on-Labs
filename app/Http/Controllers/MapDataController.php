<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use App\Models\Polygon;
use Illuminate\Http\Request;

class MapDataController extends Controller
{
    public function index()
    {
        return view('interactive');
    }

    public function getMarkers()
    {
        
        return response()->json(Marker::all());
    }

    public function getPolygons()
    {
        return response()->json(Polygon::all());
    }

    public function storeMarker(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $marker = Marker::create($request->all());
        return response()->json($marker);
    }

    public function storePolygon(Request $request)
    {
        $polygon = Polygon::create([
            'coordinates' => json_encode($request->coordinates),
        ]);
        return response()->json($polygon);
    }

    public function destroyMarker($id)
    {
        $marker = Marker::findOrFail($id);
        $marker->delete();
    }

    public function destroyPolygon($id)
    {
        $polygon = Polygon::findOrFail($id);
        $polygon->delete();
    }

    public function getMarkerById($id)
    {
        $marker = Marker::findorFail($id);
        return response()->json($marker);
    }

    public function getPolygonById($id) {
        $polygon = Polygon::findOrFail($id);
        return response()->json($polygon);
    }

    public function updateMarker(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $marker = Marker::findOrFail($id);


        $marker->name = $request->input('name');
        $marker->latitude = $request->input('latitude');
        $marker->longitude = $request->input('longitude');

        $marker->save();

        return response()->json([
            'success' => true,
            'message' => 'Marker updated successfully',
            'data' => $marker,
        ], 200);
    }

    public function updatePolygon(Request $request, $id) {
        
        $polygon = Polygon::findOrFail($id);

        $polygon->coordinates = json_decode($request->coordinates);

        $polygon->save();

        return response()->json([
            'success' => true,
            'message' => 'Marker updated successfully',
        ], 200);
    }
}
