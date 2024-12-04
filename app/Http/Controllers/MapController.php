<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //
    public function index() {
        return view('map');
    }

    public function tugas() {
        return view('map-tugas');
    }
}
