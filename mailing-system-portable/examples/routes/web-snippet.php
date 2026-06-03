<?php

/**
 * Add to routes/web.php (or your site routes file).
 */
use App\Http\Controllers\Site\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('con-store');

// Customize trip (if you use that feature)
// Route::post('/customize-create', [CustomizeTripController::class, 'store'])->name('custom-trip-store');
