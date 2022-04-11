<?php

use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

Route::get('products', [ProductController::class, 'list'])->name('product-list');
Route::get('products/{product:id}', [ProductController::class, 'detail'])->name('product-detail');
Route::get('products/import/update-data', [ProductController::class, 'importData'])->name('product-import-data');

// Route::get('mail', function() {
//     $mail = new UpdateProductDataMailable;
//     Mail::to('dgranh@gmail.com')->send($mail);

//     return "Mensaje enviado";
// });

require __DIR__.'/auth.php';
