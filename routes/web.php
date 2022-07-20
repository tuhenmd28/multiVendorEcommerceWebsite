<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::prefix('/admin')->group(function(){

    // admin login route
    Route::get('login', [ AdminController::class,'login'] );
    Route::post('login', [ AdminController::class,'login'] );
    
    Route::group(['middleware'=>['admin']],function(){
        //  admin dashboard route
        Route::get('dashboard', [ AdminController::class,'index'] );

        // update admin password
        Route::match(['get','post'],'update-admin-password',[AdminController::class,"UpdateAdminPassword"]);
        // update admin password
        Route::match(['get','post'],'update-admin-details',[AdminController::class,"UpdateAdminDetails"]);
        // update vendor details
        Route::match(['get','post'],'update-vendor-details/{slug}',[AdminController::class,'updateVendorDetails']);
        // check Admin Password
        Route::post('check-admin-password',[AdminController::class,"checkPassword"]);

        // admin logout route
        Route::get('logout',[AdminController::class,'logout']);
    });
});