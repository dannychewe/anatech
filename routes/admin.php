<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PodcastController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\NewsletterAdminController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);


// PRODUCT CATEGORIES
Route::prefix('product_categories')->name('product_categories.')->group(function () {

    Route::get('/',         [ProductCategoryController::class, 'index'])->name('index');
    Route::get('/create',   [ProductCategoryController::class, 'create'])->name('create');
    Route::post('/',        [ProductCategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [ProductCategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}',      [ProductCategoryController::class, 'update'])->name('update');
    Route::delete('/{category}',   [ProductCategoryController::class, 'destroy'])->name('destroy');

});


Route::resource('services', ServiceController::class);

Route::resource('blogs', BlogController::class);

Route::resource('categories', CategoryController::class);

Route::resource('tags', TagController::class);

Route::resource('events', EventController::class);


Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);


Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::put('about', [AboutController::class, 'update'])->name('about.update');


Route::resource('podcasts', PodcastController::class);



Route::get('footer', [FooterController::class, 'index'])->name('footer.index');
Route::post('footer', [FooterController::class, 'update'])->name('footer.update');




Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');


Route::resource('team-members', \App\Http\Controllers\Admin\TeamMemberController::class);


Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);


Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('/export/csv', [BookingController::class, 'exportCsv'])->name('bookings.export.csv');
    Route::get('/export/pdf', [BookingController::class, 'exportPdf'])->name('bookings.export.pdf');
});


// Newsletter subscribers & campaigns
Route::prefix('newsletter')->group(function () {
    // List subscribers
    Route::get('/', [NewsletterAdminController::class, 'index'])->name('newsletter.index');

    // Export subscribers
    Route::get('/export/csv', [NewsletterAdminController::class, 'exportCsv'])->name('newsletter.export.csv');
    Route::get('/export/pdf', [NewsletterAdminController::class, 'exportPdf'])->name('newsletter.export.pdf');

    Route::get('/campaigns/create', [NewsletterAdminController::class, 'createCampaign'])
    ->name('newsletter.campaigns.create');

    Route::post('/campaigns', [NewsletterAdminController::class, 'storeCampaign'])
        ->name('newsletter.campaigns.store');
});