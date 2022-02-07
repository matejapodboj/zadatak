<?php

use App\Http\Controllers\ProductCategoryController;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('loadFile', [ProductCategoryController::class, 'getFile']);

Route::get('categories', [ProductCategoryController::class, 'showAllCategories']);
Route::put('categories', [ProductCategoryController::class, 'renameCategory']);
Route::delete('categories', [ProductCategoryController::class, 'deleteCategory']);

Route::get('products', [ProductCategoryController::class, 'showProducts']);
Route::get('products/categories', [ProductCategoryController::class, 'showCategoryProduct']);
Route::put('products', [ProductCategoryController::class, 'updateProduct']);
Route::delete('products', [ProductCategoryController::class, 'deleteProduct']);

