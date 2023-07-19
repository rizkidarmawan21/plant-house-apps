<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\Transaction;
use App\Http\Controllers\ArticleController as ViewArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CekOngkirController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/details/{slug}', [DetailController::class, 'index'])->name('detail');

ROute::controller(ViewArticleController::class)->prefix('articles')->name('article.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('show');
});

Route::controller(CartController::class)->middleware('auth')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store/{product}', 'store')->name('store');
    Route::post('/update/{cart}', 'updateQuantity')->name('update');
    Route::delete('{cart}/delete', 'destroy')->name('destroy');
    Route::get('/success', 'success')->name('success');
});

Route::controller(CekOngkirController::class)->prefix('ongkir')->name('ongkir.')->group(function () {
    Route::get('get-city', 'getCity')->name('get-city');
    Route::get('get-city/{city}', 'getDetailCity')->name('get-detail-city');
    Route::get('get-province', 'getProvincy')->name('get-province');

    Route::get('get-cost', 'cekOngkir')->name('get-cost');
});

Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
    Route::post('/', 'checkout')->name('process')->middleware('auth');

    Route::get('/midtrans/callback', 'midtransCallback')->name('midtrans-callback');
    Route::post('/midtrans/callback', 'midtransCallback')->name('midtrans-callback');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('profile');

    Route::controller(MyTransactionController::class)->middleware('auth')->prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/accept-shipping/{id}', 'terimaPesanan')->name('acceptShipping');
    });

    Route::controller(ReviewController::class)->middleware('auth')->prefix('review')->name('review.')->group(function () {
        Route::get('/{id}', 'index')->name('index');
        Route::post('/{id}', 'store')->name('store');
    });
});

Route::get('/register/success', function () {
    return view('auth.success');
})->name('register-success')->middleware('auth');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);

    Route::get('product/cekSlug', [ProductController::class, 'cekSlug'])->name('product.cekSlug');
    Route::post('product/{product}/upload/image', [ProductController::class, 'addImage'])->name('product.upload.image');
    Route::delete('product/delete/{image}/image', [ProductController::class, 'destroyImage'])->name('product.delete.image');
    Route::resource('product', ProductController::class);

    Route::controller(ProductVariantController::class)->prefix('product/variant')->name('product.variant.')->group(function () {
        Route::get('create/{product}', 'create')->name('create');
        Route::post('store/{product}', 'store')->name('store');
        Route::get('edit/{variant}', 'edit')->name('edit');
        Route::put('update/{variant}', 'update')->name('update');
    });

    Route::resource('transaction', Transaction::class);

    Route::get('article/cekSlug', [ArticleController::class, 'cekSlug'])->name('articles.cekSlug');
    Route::resource('article', ArticleController::class);
});

Auth::routes();
