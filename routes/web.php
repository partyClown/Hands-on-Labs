<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\MapDataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map',[MapController::class,'index'])->name('map.latihan1');
Route::get("/tugas1", [MapController::class, 'tugas'])->name('map.tugas1');
Route::get('/tugas2', [MapController::class, 'tugas2'])->name('map.tugas2');

// interactive -> digunakan untuk menampilakn view map dan form data
Route::get('/interactive', [MapDataController::class, 'index'])->name('map.index');

// Route::get('/api/markers', [MapDataController::class, 'getMarkers']);
// Route::get('/api/markers/{id}', [MapDataController::class, 'getMarkerById']);
// Route::get('/api/polygons', [MapDataController::class, 'getPolygons']);
// Route::get('/api/polygons/{id}', [MapDataController::class, 'getPolygonById']);
// Route::post('/api/markers', [MapDataController::class, 'storeMarker']);
// Route::post('/api/polygons', [MapDataController::class, 'storePolygon']);
// Route::delete('/api/markers/{id}', [MapDataController::class, 'destroyMarker'])->name('marker.destroy');
// Route::delete('/api/polygons/{id}', [MapDataController::class, 'destroyPolygon'])->name('polygon.destroy');
// Route::put('/api/markers/{id}', [MapDataController::class, 'updateMarker'])->name('marker.update');
// Route::put('/api/polygons/{id}', [MapDataController::class, 'updatePolygon'])->name('polygon.update');

/*
    use App\Http\Controllers\MapDataController;
// interactive -> digunakan untuk menampilakn view map dan form data
Route::get('/interactive', [MapDataController::class, 'index'])->name('map.index');
// post markers -> digunakan untuk menyimpan data markers
Route::post('/markers', [MapDataController::class, 'storeMarker'])->name('map.storeMarker');
// post polygon -> menyimpan data poligon
Route::post('/polygons', [MapDataController::class, 'storePolygon'])->name('map.storePolygon');
// get data : mengambil data dari data spasial yang sudah disimpan ke database.
Route::get('/data', [MapDataController::class, 'getData'])->name('map.getData');


*/