<?php


use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\DeliveryAreaController;
use App\Http\Controllers\Staff\OrderController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\ProductGalleryController;
use App\Http\Controllers\Staff\ProductOptionController;
use App\Http\Controllers\Staff\ProductSizeController;
use App\Http\Controllers\Staff\ProfileController;
use App\Http\Controllers\Staff\ReservationController;
use App\Http\Controllers\Staff\ReservationTimeController;
use App\Http\Controllers\Staff\SettingController;
use App\Http\Controllers\Staff\TableController;
use App\Http\Controllers\Staff\StaffDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {

    Route::get('dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // product gallery routes
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

    //product size route
    Route::get('product-size/{product}', [ProductSizeController::class, 'index'])->name('product-size.show-index');
    Route::resource('product-size', ProductSizeController::class);

    Route::resource('product-option', ProductOptionController::class);

    // Delivery Area Routes
    Route::resource('delivery-area', DeliveryAreaController::class);

    // Order Routes
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('pending-orders', [OrderController::class, 'pendingOrderIndex'])->name('pending-orders');
    Route::get('inprocess-orders', [OrderController::class, 'inProcessOrderIndex'])->name('inprocess-orders');
    Route::get('delivered-orders', [OrderController::class, 'deliveredOrderIndex'])->name('delivered-orders');
    Route::get('declined-orders', [OrderController::class, 'declinedOrderIndex'])->name('declined-orders');

    Route::get('orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
    Route::put('orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

    //Reservation Routes
    Route::resource('reservation-time', ReservationTimeController::class);
    Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('reservation', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

    //TABLE RESOURCE ROUTE
    Route::resource('table', TableController::class);

});
