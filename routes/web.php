<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;

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
        // view Admins / subadmins / vendors
        Route::get('admins/{slug?}',[AdminController::class, 'admins']);
        // view vendor details
        Route::get('view-vendor-details/{id}',[AdminController::class,'viewVendorDetails']);
        // admin status update
        Route::post('update-admin-status',[AdminController::class,"updateAdminStatus"]);
        // admin logout route
        Route::get('logout',[AdminController::class,'logout']);
        
        // section route 
        Route::get('sections',[SectionController::class,"section"]);
        // section status update
        Route::post('update-section-status',[SectionController::class,"updateSectionStatus"]);
        Route::get('delete-section/{id}',[SectionController::class,'deleteSection']);
        Route::match(['get','post'],'add-edit-section/{id?}',[SectionController::class,'editSection']);
        // categories route
        Route::get('categories',[CategoryController::class,'categories']);
        Route::post('update-category-status',[CategoryController::class,"updateCategoryStatus"]);
        Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class,'editCategory']);
        Route::get('/append-categories-lavel',[CategoryController::class,'appendCategoryLavel']);
    });
});