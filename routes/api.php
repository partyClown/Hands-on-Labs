<?php

use App\Http\Controllers\MapDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/markers', [MapDataController::class, 'getMarkers']);
Route::get('/markers/{id}', [MapDataController::class, 'getMarkerById']);
Route::get('/polygons', [MapDataController::class, 'getPolygons']);
Route::get('/polygons/{id}', [MapDataController::class, 'getPolygonById']);
Route::post('/markers', [MapDataController::class, 'storeMarker']);
Route::post('/polygons', [MapDataController::class, 'storePolygon']);
Route::delete('/markers/{id}', [MapDataController::class, 'destroyMarker'])->name('marker.destroy');
Route::delete('/polygons/{id}', [MapDataController::class, 'destroyPolygon'])->name('polygon.destroy');
Route::put('/markers/{id}', [MapDataController::class, 'updateMarker'])->name('marker.update');
Route::put('/polygons/{id}', [MapDataController::class, 'updatePolygon'])->name('polygon.update');
