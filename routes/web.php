<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;

use Illuminate\Support\Facades\Route;
use Twilio\Rest\Api\V2010\Account\Call\PaymentContext;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| kdmv
*/


//AUTH ROUTE
Route::group(['middleware' => 'guest'], function () {
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('admin.forgot-password');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');
});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

/**show home page */
Route::get('/', [FrontendController::class, 'index'])->name('home');

/**show product details page */
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

/** Product Model Route */
Route::get('/load-product-modal/{productId}', [FrontendController::class, 'loadProductModal'])->name('load-product-modal');

/**add to cart routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class, 'getCartProduct'])->name('get-cart-products');
Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');

/**Cart Page Routes */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('/cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

/**About Routes */
Route::get('/about', [FrontendController::class, 'about'])->name('about.index');

/**Contact Routes */
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact.index');

/**Menu page Routes */
Route::get('/menu', [FrontendController::class, 'menu'])->name('menu.index');

//Reservation Routes
Route::post('/reservation', [FrontendController::class, 'reservation'])->name('reservation.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/{id}/delivery-cal', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-cal');
    Route::post('checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');
    Route::get('payment-success', [PaymentController::class, 'success'])->name('payment.success');
});
