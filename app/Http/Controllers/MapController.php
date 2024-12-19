<?php

namespace App\Http\Controllers;


class MapController extends Controller
{
    //
    public function index() {
        return view('map');
    }

    public function tugas() {
        return view('map-tugas');
    }

    public function tugas2() {
        $resMarker = (new MapDataController)->getMarkers();
        $jsonDataMarker = $resMarker->getContent();
        $markerDatas = json_decode($jsonDataMarker);

        $resPolygon = (new MapDataController)->getPolygons();
        $jsonDataPolygon = $resPolygon->getContent();
        $polygonDatas = json_decode($jsonDataPolygon);

        return view('map-tugas2', compact('markerDatas', 'polygonDatas'));
    }

}
