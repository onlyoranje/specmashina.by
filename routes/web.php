<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BbsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BbsController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard/mybb',
    [App\Http\Controllers\ProfileController::class, 'mybb'])
    ->name('mybb');
Route::get('/dashboard/add', [App\Http\Controllers\ProfileController::class, 'addForm'])->name('addForm');
Route::post('/dashboard', [App\Http\Controllers\ProfileController::class, 'addBb'])->name('addBbToDB');
Route::get('/dashboard/{bb}/edit',[App\Http\Controllers\ProfileController::class, 'editBb'])->name('bb_edit')->middleware('can:update,bb');
Route::patch('/dashboard/{bb}',[App\Http\Controllers\ProfileController::class, 'updateBb'])->name('bb_update')->middleware('can:update,bb');
Route::get('/dashboard/{bb}/delete',[App\Http\Controllers\ProfileController::class, 'deleteBb'])->name('bb_delete')->middleware('can:destroy,bb');
Route::delete('/dashboard/{bb}',[App\Http\Controllers\ProfileController::class, 'destroyBb'])->name('bb_destroy')->middleware('can:destroy,bb');
//Route::get('/announcements/{bb}',[App\Http\Controllers\AnnouncementsController::class, 'detail'])->name('announcement_detail');

Route::get('/rubric', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubrics');
Route::get('/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubric');
Route::get('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'rubrics'])->name('rubric_dashboard')->middleware('auth');
Route::post('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'addRubric'])->name('addRubricToDB')->middleware('auth');
Route::get('/dashboard/rubric/add', [App\Http\Controllers\RubricsController::class, 'addRubricForm'])->name('rubric_dashboard_add')->middleware('auth');
Route::get('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'detail'])->name('rubric_dashboard_edit')->middleware('auth');
Route::patch('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'editRubric'])->name('editRubricToDB')->middleware('auth');
Route::get('/dashboard/rubric/{rubric}/delete', [App\Http\Controllers\RubricsController::class, 'delete'])->name('rubric_dashboard_delete')->middleware('auth');
Route::delete('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'destroyRubric'])->name('rubric_dashboard_destroy')->middleware('auth');

Route::get('/location', [App\Http\Controllers\LocationsController::class, 'location'])->name('locations');
Route::get('/location/{location}', [App\Http\Controllers\LocationsController::class, 'location'])->name('location');
Route::get('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'locations'])->name('location_dashboard')->middleware('auth');
Route::post('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'addLocation'])->name('addLocationToDB')->middleware('auth');
Route::get('/dashboard/location/add', [App\Http\Controllers\LocationsController::class, 'addLocationForm'])->name('location_dashboard_add')->middleware('auth');
Route::get('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'detail'])->name('location_dashboard_edit')->middleware('auth');
Route::patch('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'editLocation'])->name('editLocationToDB')->middleware('auth');
Route::get('/dashboard/location/{location}/delete', [App\Http\Controllers\LocationsController::class, 'delete'])->name('location_dashboard_delete')->middleware('auth');
Route::delete('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'destroyLocation'])->name('location_dashboard_destroy')->middleware('auth');

Route::get('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'parameters'])->name('parameter_dashboard')->middleware('auth');
Route::post('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'addParameter'])->name('addParameterToDB')->middleware('auth');
Route::get('/dashboard/parameter/add', [App\Http\Controllers\ParametersController::class, 'addParameterForm'])->name('parameter_dashboard_add')->middleware('auth');
Route::get('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'detail'])->name('parameter_dashboard_edit')->middleware('auth');
Route::patch('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'editParameter'])->name('editParameterToDB')->middleware('auth');
Route::get('/dashboard/parameter/{parameter}/delete', [App\Http\Controllers\ParametersController::class, 'delete'])->name('parameter_dashboard_delete')->middleware('auth');
Route::delete('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'destroyParameter'])->name('parameter_dashboard_destroy')->middleware('auth');


Route::get('image', 'ImageController@index');
Route::post('store', 'ImageController@store');


require __DIR__.'/auth.php';
Route::get('/{bb}', [BbsController::class, 'detail'])->name('bb');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
