<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\BookController;
use App\Http\Controllers\Site\CategoriesController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\DestiontionController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NileCruiseController;
use App\Http\Controllers\Site\TourController;
use App\Http\Controllers\Site\RoomController;
use App\Http\Controllers\Site\TourTailorController;
use App\Http\Controllers\Site\TransportationController;
use App\Http\Controllers\Site\CustomizeTripController;
use App\Http\Controllers\Site\CouponController;
use App\Http\Controllers\Site\ClientAuth_Controller;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\OffersController;
use App\Http\Controllers\Site\NewsletterController;
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Site\ReviewController;
use App\Http\Controllers\Site\ClientController;
use App\Http\Controllers\Site\ServiceController;
use App\Http\Controllers\Site\LimoController;
use App\Models\Currency;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'as' => 'site.'
], function () {
    Route::get('/limo', [LimoController::class, 'index'])->name('limo.home');
    Route::get('/limo/complete-booking', [LimoController::class, 'completingBooking'])->name('limo.completing-booking');
    Route::post('/limo/complete-booking', [LimoController::class, 'storeLimoBooking'])->name('limo.complete-booking.store');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/filter-featured-tours', [HomeController::class, 'filterFeaturedTours'])->name('home.filter-featured-tours');
    Route::post('/make-appointment', [HomeController::class, 'makeAppointment'])->name('make-appointment');
    Route::get('/tours/search', [TourController::class, 'search'])->name('tour.search');
    Route::get('travel-packages', [CategoryController::class, 'travelPackages'])->name('travel-packages');
    Route::get('/tours/{destination}/{category}', [TourController::class, 'destinationCategoriesSearch'])->name('tour.destination.categories.search');
   // Route::get('categories/{slug}', [CategoriesController::class, 'index'])->name('category');
   Route::get('/tour-details/{slug}', [TourController::class, 'tour_details'])->name('tour_details');
   Route::get('/room-details/{slug}', [RoomController::class, 'room_details'])->name('room_details');
   Route::get('/rooms-list', [RoomController::class, 'rooms'])->name('rooms');
   Route::post('/pricing', [TourController::class, 'pricing'])->name('pricing');
    Route::get('/destination-details/{slug}', [DestiontionController::class, 'des_details'])->name('des-details');
    Route::get('/day-tours', [DestiontionController::class, 'dayTours'])->name('day-tours');
    Route::get('/tour-tailors', [TourTailorController::class, 'index'])->name('tour_tailors');
    Route::post('/tour-tailors/create', [TourTailorController::class, 'store'])->name('create_tour_tailors');
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('myprofile');

    //auth
    Route::post('login-client', [AuthController::class, 'login'])->name('login-client');
    Route::post('register-client', [AuthController::class, 'register'])->name('register-client');
    Route::post('logout-client', [AuthController::class, 'logout'])->name('logout-client');
    Route::get('/cal', [AboutController::class, 'cal'])->name('calender');

    Route::post('/book', [BookController::class, 'book'])->name('book');
    Route::post('/coupon', [CouponController::class, 'coupon'])->name('coupon');
    Route::post('/book-service', [BookController::class, 'book_service'])->name('book-service');
    Route::post('/news/letters', [HomeController::class, 'newsLetter'])->name('newsLetter');

    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/terms&conditions', [AboutController::class, 'terms'])->name('terms');
    Route::get('/privacy', [AboutController::class, 'privacy'])->name('privacy');
    Route::get('/Our-Team', [AboutController::class, 'teams'])->name('teams');
    Route::get('/gallery', [AboutController::class, 'gallery'])->name('gallery');
    Route::get('/faq/{id?}', [FaqController::class, 'index'])->name('faq');
    Route::get('/Customize-your-trip', [CustomizeTripController::class, 'index'])->name('custom-trip');
    Route::post('/Customize-create', [CustomizeTripController::class, 'store'])->name('custom-trip-store');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/transportation', [TransportationController::class, 'index'])->name('transportation.index');
    Route::get('/nile-cruise', [TourController::class, 'NileCruise'])->name('nile-cruise');
    Route::get('/nile-cruise/{slug}', [TourController::class, 'NileCruiseDetails'])->name('nile-cruise-tours');
    Route::get('/offers', [OffersController::class, 'offer'])->name('offer');
    Route::post('/subscribe', [NewsletterController::class, 'subs'])->name('subs');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/filter', [SearchController::class, 'filter'])->name('filter');
    Route::get('/package/{title}', [SearchController::class, 'package'])->name('package');
//    Route::get('/nile-cruise', [NileCruiseController::class, 'index'])->name('nile-cruise');
    Route::get('/blog-details/{id}', [BlogController::class ,'details' ])->name('blog-details');
    Route::get('/blog-tags/{tag}', [BlogController::class ,'tag' ])->name('tag-details');
    Route::get('/blog-category/{id}', [BlogController::class ,'blog_category' ])->name('blog-category');
    Route::post('/review', [ReviewController::class, 'store'])->name('review');
    Route::get('service/{page}', [ServiceController::class, 'index'])->name('service');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('con-store');
    Route::post('/request-call',[HomeController::class,'call'])->name('req-call');

});
Route::get('callback', [BookController::class, 'callback'])->name('callback');
Route::get('paypal', [BookController::class, 'paypal'])->name('paypal');
Route::get('paypal/success', [BookController::class, 'success'])->name('success');
Route::get('paypal/cancel', [BookController::class, 'cancel'])->name('cancel');
Route::post('login-client', [ClientAuth_Controller::class, 'login'])->name('login-client');
Route::get('login-page', [ClientAuth_Controller::class, 'login_page'])->name('login-page');
Route::get('sign-up', [ClientAuth_Controller::class, 'register_page'])->name('register-page');
Route::post('register-client', [ClientAuth_Controller::class, 'register'])->name('register-client');
Route::post('add-wishlist', [ClientController::class, 'add_to_wishlist'])->name('add-wishlist');
Route::put('update-client', [ClientAuth_Controller::class, 'update'])->name('update-profile');
Route::post('reset-client/password', [ClientAuth_Controller::class, 'updatePassword'])->name('update-password');
Route::get('auth/google', [ClientAuth_Controller::class, 'googlepage'])->name('google-login');
Route::get('google/callback', [ClientAuth_Controller::class, 'Callback'])->name('google-callback');
Route::post('download-invoice', [BookController::class, 'download'])->name('download-invoice');
Route::get('currency/switch/{name}', function ($name) {
    change_currency(Currency::where('name',$name)->first());
    return back();
})->name('currency.switch');
