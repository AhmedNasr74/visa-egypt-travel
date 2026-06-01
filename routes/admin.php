<?php
use App\Http\Controllers\Dashboard\AutoTranslationController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\DestinationController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\TourOptionController;
use App\Http\Controllers\Dashboard\TourController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CustomizedCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AppointmentController;
use App\Http\Controllers\Dashboard\CustomizedTripController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\FaqCategoryController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\DiscountController;
use App\Http\Controllers\Dashboard\RaiseController;
use App\Http\Controllers\Dashboard\SubscribeController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\CurrencyController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CarRentalController;
use App\Http\Controllers\Dashboard\CarRouteController;
use App\Http\Controllers\Dashboard\LocationController;
//controllers
Route::group(['prefix' => 'dashboard',
    'middleware' => ['auth:web', 'permitted'],
    'as' => 'dashboard.'],
    function () {
        Route::get('optimize', function() {
            Artisan::call('optimize:clear');
            return 'App Optimized!';
        })->name('optimize');
        Route::post('translate'  , [AutoTranslationController::class, 'translate'])->name('model.auto.translate');
        Route::get('toggle-theme', [ProfileController::class, 'toggleTheme'])->name('toggle-theme');
        Route::resource('users', UserController::class)->except('show');
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('clients', ClientController::class)->except('show');
        Route::resource('destinations', DestinationController::class)->except('show');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('coupons', CouponController::class)->except('show');
        Route::resource('tours', TourController::class);
        Route::get('tours/{tour}/duplicate', [TourController::class, 'duplicate'])->name('tours.duplicate');
        Route::resource('currencies', CurrencyController::class)->except('show');
        Route::get('tours/options', [TourController::class, 'options'])->name('tours.options');
//        Route::resource('newsletters', NewsLetters::class)->except('show');
        Route::resource('tour-options', TourOptionController::class)->except('show');
        Route::resource('sliders', SliderController::class)->except('show');
        Route::resource('bookings', BookingController::class);
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('show', [SettingController::class, 'show'])->name('show');
            Route::put('update', [SettingController::class, 'update'])->name('update');
        });
        Route::resource('appointments', AppointmentController::class)->only(['index', 'show']);
        Route::resource('customized-categories', CustomizedCategoryController::class)->except('show');
        Route::resource('customized-trips', CustomizedTripController::class);
        Route::resource('faq-categories', FaqCategoryController::class)->except('show');
        Route::resource('faqs', FaqController::class)->except('show');
        Route::resource('blog-categories', BlogCategoryController::class)->except('show');
        Route::resource('blogs', BlogController::class)->except('show');
        Route::resource('employees', EmployeeController::class)->except('show');
        Route::get('sells', [ReportController::class, 'sells'])->name('sells');
        Route::get('Search-Tour', [ReportController::class, 'tours'])->name('tours-search');
        Route::resource('discounts', DiscountController::class)->except('show');
        Route::resource('raises', RaiseController::class)->except('show');
        Route::resource('subscribes', SubscribeController::class)->except('show');
        Route::get('email', [SubscribeController::class,'email'])->name('email');
        Route::post('Send-email', [SubscribeController::class,'Send_email'])->name('Send-Email');
        Route::resource('comments', CommentController::class)->except('show');
        Route::resource('pages', PageController::class)->except('show');
        Route::resource('contacts', ContactController::class)->except('show');

        Route::resource('locations', LocationController::class)->except('show');

        Route::get('car-routes/template', [CarRouteController::class, 'template'])->name('car-routes.template');
        Route::post('car-routes/import', [CarRouteController::class, 'import'])->name('car-routes.import');
        Route::resource('car-routes', CarRouteController::class)->except('show');

        Route::resource('car-rentals', CarRentalController::class)->only(['index', 'show']);
    //RoutePlace
    });
    Route::get('ip',[TourController::class,'all']);
