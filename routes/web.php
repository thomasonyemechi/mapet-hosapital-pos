<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});



Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/items', [ItemController::class, 'getItems']);
Route::get('/search', [ItemController::class, 'searchItem']);

Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware' => ['auth']], function () {


    Route::get('/pos', function () {
        return view('pos.pos');
    });

    Route::post('/make_slaes', [SalesController::class, 'makeSales']);
    Route::get('/today_sales/{id?}/{date?}', [SalesController::class, 'todaySales']);

    Route::group(['prefix' => 'item'], function () {
        Route::get('/add', [ItemController::class, 'addItemIndex']);
        Route::post('/add', [ItemController::class, 'addItem']);
        Route::post('/update', [ItemController::class, 'updateItem']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/add', [CategoryController::class, 'index']);
        Route::post('/add', [CategoryController::class, 'addCategory']);
    });





    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::get('/dashboard', [AdminController::class, 'renderIndex']);

        Route::group(['prefix' => 'stock'], function () {
            Route::get('/restock', [StockController::class, 'restockIndex']);
            Route::post('/restock', [StockController::class, 'restockItem']);
        });
    
   
    

        
    });
});
