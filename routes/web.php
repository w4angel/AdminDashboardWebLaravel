<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UploadImageController;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'admin']], function (){
   
   Route::get('/dashboard', function () {
     return view('admin.dashboard');
    });
    
    Route::get('/dashboard',[DashboardController::class,'show']);
    Route::get('/role-register',[DashboardController::class,'registered']);
    Route::get('/role-edit/{id}',[DashboardController::class,'registeredit']);
    Route::put('/role-register-update/{id}',[DashboardController::class,'registerupdate']);
   // Route::delete('role-delete/{id}',[DashboardController::class,'registerdelete']);
    
   Route::get('/abouts',[AboutUsController::class,'index']);
    Route::post('/save-aboutus', [AboutUsController::class,'store']);
    Route::get('/about-us/{id}',[AboutUsController::class,'edit']);
    Route::put('/aboutus-update/{id}',[AboutUsController::class,'update']);
    Route::delete('/about-us-delete/{id}',[AboutUsController::class,'delete']);
    
});
