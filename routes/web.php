<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/api', function () {
    return view('data_api');
})->name('data_api');

Route::name('invoice.')->prefix('invoice')->group( function(){
    Route::get("/index", [InvoiceController::class, 'index'])->name("index");
    Route::get("/create", [InvoiceController::class, 'create'])->name("create");
    Route::post("/store", [InvoiceController::class, 'store'])->name("store");
    Route::get("/show/{id}", [InvoiceController::class, 'show'])->name("show");
    Route::get("/edit/{id}", [InvoiceController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [InvoiceController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [InvoiceController::class, 'delete'])->name("delete");
});

Route::name('invoice_detail.')->prefix('invoice/item/{invoiceID}')->group( function(){
    Route::get("/index", [InvoiceItemController::class, 'index'])->name("index");
    Route::post("/store", [InvoiceItemController::class, 'store'])->name("store");
    Route::get("/edit/{id}", [InvoiceItemController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [InvoiceItemController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [InvoiceItemController::class, 'delete'])->name("delete");
    Route::post("/update-status", [InvoiceItemController::class, 'updateStatus'])->name("updateStatus");
});

Route::name('params.type.')->prefix('params/type')->group( function(){
    Route::get("/index", [TypeController::class, 'index'])->name("index");
    Route::get("/create", [TypeController::class, 'create'])->name("create");
    Route::post("/store", [TypeController::class, 'store'])->name("store");
    Route::get("/edit/{id}", [TypeController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [TypeController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [TypeController::class, 'delete'])->name("delete");
});

Route::name('params.client.')->prefix('params/client')->group( function(){
    Route::get("/index", [ClientController::class, 'index'])->name("index");
    Route::get("/create", [ClientController::class, 'create'])->name("create");
    Route::post("/store", [ClientController::class, 'store'])->name("store");
    Route::get("/edit/{id}", [ClientController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [ClientController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [ClientController::class, 'delete'])->name("delete");
});

Route::name('params.company.')->prefix('params/company')->group( function(){
    Route::get("/index", [CompanyController::class, 'index'])->name("index");
    Route::get("/create", [CompanyController::class, 'create'])->name("create");
    Route::post("/store", [CompanyController::class, 'store'])->name("store");
    Route::get("/edit/{id}", [CompanyController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [CompanyController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [CompanyController::class, 'delete'])->name("delete");
});

Route::name('params.product.')->prefix('params/product')->group( function(){
    Route::get("/index", [ProductController::class, 'index'])->name("index");
    Route::get("/create", [ProductController::class, 'create'])->name("create");
    Route::post("/store", [ProductController::class, 'store'])->name("store");
    Route::get("/edit/{id}", [ProductController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [ProductController::class, 'update'])->name("update");
    Route::get("/delete/{id}", [ProductController::class, 'delete'])->name("delete");
});