<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\ProductsController;

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
    return view('admin/login');
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
        Route::get('delete-category/{id}',[CategoryController::class,"deleteCategory"]);
        Route::get('delete-category-image/{id}',[CategoryController::class,"deleteCategoryImage"]);
        // brands Route
        Route::get('brands',[BrandController::class,"brand"]);
        // Brands status update
        Route::post('update-brand-status',[BrandController::class,"updateBrandStatus"]);
        Route::get('delete-brand/{id}',[BrandController::class,'deleteBrand']);
        Route::match(['get','post'],'add-edit-brand/{id?}',[BrandController::class,'editBrand']);
        // Products Route
        Route::get('products',[ProductsController::class,"products"]);
        // Brands status update
        Route::post('update-product-status',[ProductsController::class,"updateProductStatus"]);
        Route::get('delete-product/{id}',[ProductsController::class,'deleteProduct']);
        });
        Route::match(['get','post'],'add-edit-product/{id?}',[ProductsController::class,"addEditProduct"]);
        Route::get('delete-product-image/{id}',[ProductsController::class,"deleteProductImage"]);
        Route::get('delete-product-video/{id}',[ProductsController::class,"deleteProductVideo"]);
        // add attributes
        Route::match(['get','post'],'add-edit-attributes/{id}',[ProductsController::class,'addAttributes']);
        Route::match(['get','post'],'edit-attribute/{id}',[ProductsController::class,'editAttribute']);
        // add product Image
        Route::match(['get','post'],'add-edit-images/{id}',[ProductsController::class,'addImage']);
        Route::post('update-image-status',[ProductsController::class,'updateProductImageStatus']);
        Route::get('delete-image/{id}',[ProductsController::class,'deleteImage']);
});
