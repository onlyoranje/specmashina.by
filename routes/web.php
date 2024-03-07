<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/', [BbsController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'MyOrganization'])->name('my_organization')->middleware('auth');
Route::get('/dashboard/organization/add', [App\Http\Controllers\ProfileController::class, 'addOrganization'])->name('organization_add')->middleware('auth');
Route::get('/dashboard/organization/edit', [App\Http\Controllers\ProfileController::class, 'editOrganization'])->name('organization_edit')->middleware('auth');
Route::get('/dashboard/organization/delete', [App\Http\Controllers\ProfileController::class, 'deleteOrganization'])->name('organization_delete')->middleware('auth');
Route::post('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'addOrganizationToDB'])->name('addOrganizationToDB')->middleware('auth');
Route::patch('/dashboard/organization/{organization}',[App\Http\Controllers\ProfileController::class, 'updateOrganization'])->name('organization_update')->middleware('auth');
Route::delete('/dashboard/organization', [App\Http\Controllers\ProfileController::class, 'destroyOrganization'])->name('organization_destroy')->middleware('auth');

Route::get('/dashboard/mybb',[App\Http\Controllers\ProfileController::class, 'mybb'])->name('mybb');
Route::get('/dashboard/mybb/add', [App\Http\Controllers\ProfileController::class, 'addForm'])->name('addForm');
Route::post('/dashboard/mybb', [App\Http\Controllers\ProfileController::class, 'addBb'])->name('addBbToDB');
Route::get('/dashboard/mybb/{bb}/edit',[App\Http\Controllers\ProfileController::class, 'editBb'])->name('bb_edit')->middleware('can:update,bb');
Route::patch('/dashboard/mybb/{bb}',[App\Http\Controllers\ProfileController::class, 'updateBb'])->name('bb_update')->middleware('can:update,bb');
Route::get('/dashboard/mybb/{bb}/delete',[App\Http\Controllers\ProfileController::class, 'deleteBb'])->name('bb_delete')->middleware('can:destroy,bb');
Route::delete('/dashboard/mybb/{bb}',[App\Http\Controllers\ProfileController::class, 'destroyBb'])->name('bb_destroy')->middleware('can:destroy,bb');
//Route::get('/announcements/{bb}',[App\Http\Controllers\AnnouncementsController::class, 'detail'])->name('announcement_detail');

Route::get('/rubric', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubrics');
Route::get('/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'rubric'])->name('rubric');
Route::get('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'rubrics'])->name('rubric_dashboard')->middleware('isadmin');
Route::post('/dashboard/rubric', [App\Http\Controllers\RubricsController::class, 'addRubric'])->name('addRubricToDB')->middleware('isadmin');
Route::get('/dashboard/rubric/add', [App\Http\Controllers\RubricsController::class, 'addRubricForm'])->name('rubric_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'detail'])->name('rubric_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'editRubric'])->name('editRubricToDB')->middleware('isadmin');
Route::get('/dashboard/rubric/{rubric}/delete', [App\Http\Controllers\RubricsController::class, 'delete'])->name('rubric_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/rubric/{rubric}', [App\Http\Controllers\RubricsController::class, 'destroyRubric'])->name('rubric_dashboard_destroy')->middleware('isadmin');

Route::get('/location', [App\Http\Controllers\LocationsController::class, 'location'])->name('locations');
Route::get('/location/{location}', [App\Http\Controllers\LocationsController::class, 'location'])->name('location');
Route::get('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'locations'])->name('location_dashboard')->middleware('isadmin');
Route::post('/dashboard/location', [App\Http\Controllers\LocationsController::class, 'addLocation'])->name('addLocationToDB')->middleware('isadmin');
Route::get('/dashboard/location/add', [App\Http\Controllers\LocationsController::class, 'addLocationForm'])->name('location_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'detail'])->name('location_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'editLocation'])->name('editLocationToDB')->middleware('isadmin');
Route::get('/dashboard/location/{location}/delete', [App\Http\Controllers\LocationsController::class, 'delete'])->name('location_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/location/{location}', [App\Http\Controllers\LocationsController::class, 'destroyLocation'])->name('location_dashboard_destroy')->middleware('isadmin');

Route::get('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'parameters'])->name('parameter_dashboard')->middleware('isadmin');
Route::post('/dashboard/parameter', [App\Http\Controllers\ParametersController::class, 'addParameter'])->name('addParameterToDB')->middleware('isadmin');
Route::get('/dashboard/parameter/add', [App\Http\Controllers\ParametersController::class, 'addParameterForm'])->name('parameter_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'detail'])->name('parameter_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'editParameter'])->name('editParameterToDB')->middleware('isadmin');
Route::get('/dashboard/parameter/{parameter}/delete', [App\Http\Controllers\ParametersController::class, 'delete'])->name('parameter_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/parameter/{parameter}', [App\Http\Controllers\ParametersController::class, 'destroyParameter'])->name('parameter_dashboard_destroy')->middleware('isadmin');

Route::get('/dashboard/parameter_type', [App\Http\Controllers\ParameterTypesController::class, 'types'])->name('parameter_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/parameter_type', [App\Http\Controllers\ParameterTypesController::class, 'addTypetoDB'])->name('addTypeToDB')->middleware('isadmin');
Route::get('/dashboard/parameter_type/add', [App\Http\Controllers\ParameterTypesController::class, 'addTypeForm'])->name('parameter_type_add')->middleware('isadmin');
Route::get('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'detail'])->name('parameter_type_edit')->middleware('isadmin');
Route::patch('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'editType'])->name('editTypetoDB')->middleware('isadmin');
Route::get('/dashboard/parameter_type/{type}/delete', [App\Http\Controllers\ParameterTypesController::class, 'delete'])->name('parameter_type_delete')->middleware('isadmin');
Route::delete('/dashboard/parameter_type/{type}', [App\Http\Controllers\ParameterTypesController::class, 'destroy'])->name('parameter_type_destroy')->middleware('isadmin');

Route::get('/dashboard/price_type', [App\Http\Controllers\PriceTypesController::class, 'types'])->name('price_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/price_type', [App\Http\Controllers\PriceTypesController::class, 'addTypetoDB'])->name('addPriceTypeToDB')->middleware('isadmin');
Route::get('/dashboard/price_type/add', [App\Http\Controllers\PriceTypesController::class, 'addTypeForm'])->name('price_type_add')->middleware('isadmin');
Route::get('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'detail'])->name('price_type_edit')->middleware('isadmin');
Route::patch('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'editType'])->name('editPriceTypetoDB')->middleware('isadmin');
Route::get('/dashboard/price_type/{type}/delete', [App\Http\Controllers\PriceTypesController::class, 'delete'])->name('price_type_delete')->middleware('isadmin');
Route::delete('/dashboard/price_type/{type}', [App\Http\Controllers\PriceTypesController::class, 'destroy'])->name('price_type_destroy')->middleware('isadmin');

Route::get('/dashboard/contact_type', [App\Http\Controllers\ContactTypesController::class, 'types'])->name('contact_type_dashboard')->middleware('isadmin');
Route::post('/dashboard/contact_type', [App\Http\Controllers\ContactTypesController::class, 'addTypetoDB'])->name('addContactTypeToDB')->middleware('isadmin');
Route::get('/dashboard/contact_type/add', [App\Http\Controllers\ContactTypesController::class, 'addTypeForm'])->name('contact_type_add')->middleware('isadmin');
Route::get('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'detail'])->name('contact_type_edit')->middleware('isadmin');
Route::patch('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'editType'])->name('editContactTypetoDB')->middleware('isadmin');
Route::get('/dashboard/contact_type/{type}/delete', [App\Http\Controllers\ContactTypesController::class, 'delete'])->name('contact_type_delete')->middleware('isadmin');
Route::delete('/dashboard/contact_type/{type}', [App\Http\Controllers\ContactTypesController::class, 'destroy'])->name('contact_type_destroy')->middleware('isadmin');


Route::get('/vendor', [App\Http\Controllers\VendorsController::class, 'vendor'])->name('vendors');
Route::get('/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'vendor'])->name('vendor');
Route::get('/dashboard/vendor', [App\Http\Controllers\VendorsController::class, 'vendors'])->name('vendor_dashboard')->middleware('isadmin');
Route::post('/dashboard/vendor', [App\Http\Controllers\VendorsController::class, 'addVendor'])->name('addVendorToDB')->middleware('isadmin');
Route::get('/dashboard/vendor/add', [App\Http\Controllers\VendorsController::class, 'addVendorForm'])->name('vendor_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'detail'])->name('vendor_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'editVendor'])->name('editVendorToDB')->middleware('isadmin');
Route::get('/dashboard/vendor/{vendor}/delete', [App\Http\Controllers\VendorsController::class, 'delete'])->name('vendor_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/vendor/{vendor}', [App\Http\Controllers\VendorsController::class, 'destroyVendor'])->name('vendor_dashboard_destroy')->middleware('isadmin');


Route::get('/dashboard/status_bb', [App\Http\Controllers\StatusBbController::class, 'statuses'])->name('status_dashboard')->middleware('isadmin');
Route::post('/dashboard/status_bb', [App\Http\Controllers\StatusBbController::class, 'addStatus'])->name('addStatusToDB')->middleware('isadmin');
Route::get('/dashboard/status_bb/add', [App\Http\Controllers\StatusBbController::class, 'addStatusForm'])->name('status_dashboard_add')->middleware('isadmin');
Route::get('/dashboard/status_bb/{id}', [App\Http\Controllers\StatusBbController::class, 'detail'])->name('status_dashboard_edit')->middleware('isadmin');
Route::patch('/dashboard/status_bb/{id}', [App\Http\Controllers\StatusBbController::class, 'editStatus'])->name('editStatusToDB')->middleware('isadmin');
Route::get('/dashboard/status_bb/{id}/delete', [App\Http\Controllers\StatusBbController::class, 'delete'])->name('status_dashboard_delete')->middleware('isadmin');
Route::delete('/dashboard/status_bb/{id}', [App\Http\Controllers\StatusBbController::class, 'destroyStatus'])->name('status_dashboard_destroy')->middleware('isadmin');



require __DIR__.'/auth.php';
Route::get('/item/{bb}', [BbsController::class, 'detail'])->name('bb');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


