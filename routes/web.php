<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $data['jobs'] = Job::all();
    return view('welcome', $data);
});

Route::get('/login', [AdminController::class, 'login']);
Route::post('/login', [AdminController::class, 'loginCheck'])->name('login');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('admin/job', [JobController::class, 'index'])->name('job.index');
    Route::get('admin/job/create', [JobController::class, 'create']);
    Route::get('admin/job/edit/{id}', [JobController::class, 'edit']);
    Route::post('admin/job/update', [JobController::class, 'update']);
    Route::post('admin/job/store', [JobController::class, 'store']);
    Route::get('admin/job/delete/{id}', [JobController::class, 'destroy']);

});

