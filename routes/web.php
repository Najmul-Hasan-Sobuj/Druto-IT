<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\AdminPanel\AdminController;
use App\Http\Controllers\AdminPanel\HomeSectionController;
use App\Http\Controllers\AdminPanel\WorkSectionController;
use App\Http\Controllers\AdminPanel\AboutSectionController;
use App\Http\Controllers\AdminPanel\ServiceSectionController;
//use Image;

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
    return view('welcome');
});
Route::get('/hello', function() {
    $img = Image::make('foo.jpg')->resize(300, 200);
    return $img->response('jpg');
});

Auth::routes();

Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index'])->name('homes');

//Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

// Route::post('service', [ServiceSectionController::class, 'store'])->name('service.store');
        Route::resource('service',ServiceSectionController::class);
        Route::get('/fetch-service',[ServiceSectionController::class,'fetchService']);
        Route::resource('work',WorkSectionController::class);
        Route::get('/fetch-work',[WorkSectionController::class,'fetchWork']);


Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function (){
        Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('homes',[HomeSectionController::class,'home'])->name('admin.homes');
        Route::post('update_home',[HomeSectionController::class,'update_home'])->name('update.homes');

        // Route::get('service', [ServiceSectionController::class, 'index'])->name('service.index');
        // Route::get('service/create', [ServiceSectionController::class, 'create'])->name('service.create');
        // Route::post('service', [ServiceSectionController::class, 'store'])->name('service.store');
        // Route::get('service/{id}/edit', [ServiceSectionController::class, 'edit'])->name('service.edit');
        // Route::put('service/{id}', [ServiceSectionController::class, 'update'])->name('service.update');
        // Route::delete('service/{id}', [ServiceSectionController::class, 'destroy'])->name('service.destroy');


        Route::resource('about',AboutSectionController::class);
});


// ,'middleware'=>'auth','middleware'=>'checkRole'