<?php

// Esses comandos importam classes de controllers que serão utilizadas para definir as routes
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use Backpack\Base\app\Http\Controllers\Auth\LoginController;

// Configuração das routes para a aplicação
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function(){ 
return view('adminView');});

Route::group(['middleware' => ['role:admin']], function () {
	Route::get('/admin', function(){
	return view('adminView');
	});
});

Route::resource('products', 'App\Http\Controllers\ProductController');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'storeForm'])->name('contact.store');

require __DIR__.'/auth.php';
