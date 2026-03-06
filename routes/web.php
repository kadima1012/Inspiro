<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/dashboard/become-artist', [ProfileController::class, 'becomeArtist'])->name('become.artist');
    Route::post('/dashboard/cancel-artist', [ProfileController::class, 'cancelArtist'])->name('cancel.artist');
    Route::post('/dashboard/profile/confirm-cancel-artist', [ProfileController::class, 'confirmCancelArtist'])->name('profile.confirm-cancel-artist');

    // Gallery pending
    Route::get('/dashboard/gallery/pending', [GalleryController::class, 'pending'])->name('gallery.pending');

    // Artists
    Route::get('/dashboard/artists/admin', [ArtistsController::class, 'index'])->name('artists.admin');
    Route::get('/dashboard/portfolio', [ArtistsController::class, 'portfolio'])->name('portfolio');
    Route::get('/dashboard/portfolio/{id}', [ArtistsController::class, 'show'])->name('artist.show');
    Route::get('/dashboard/sale', [ArtistsController::class, 'sale'])->name('sale');
    Route::get('/dashboard/artist/{id}/edit', [ArtistsController::class, 'edit'])->name('artist.edit');
    Route::put('/dashboard/artist/{idArtist}', [ArtistsController::class, 'update'])->name('artist.update');

    // Artworks
    Route::get('/dashboard/artwork/create', [ArtworkController::class, 'create'])->name('artwork.create');
    Route::post('/dashboard/artwork/store', [ArtworkController::class, 'store'])->name('artwork.store');
    Route::get('/dashboard/artwork/{id}/edit', [ArtworkController::class, 'edit'])->name('artwork.edit');
    Route::put('/dashboard/artwork/{id}', [ArtworkController::class, 'update'])->name('artwork.update');
    Route::delete('/dashboard/artwork/{id}', [ArtworkController::class, 'destroy'])->name('artwork.destroy');
    Route::get('/dashboard/artwork/{id}/showAddToMarket', [ArtworkController::class, 'showAddToMarket'])->name('artwork.showAddToMarket');
    Route::post('/dashboard/artwork/add-to-market/{idArt}', [ArtworkController::class, 'addToMarket'])->name('artwork.addToMarket');
    Route::post('/dashboard/artwork/{id}/remove-from-market', [ArtworkController::class, 'removeFromMarket'])->name('artwork.removeFromMarket');

    // Orders & Basket
    Route::get('/dashboard/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/dashboard/basket', [OrdersController::class, 'showBasket'])->name('basket');
    Route::get('/add-to-basket/{idArt}', [OrdersController::class, 'showConfirmAddToBasket'])->name('showConfirmAddToBasket');
    Route::post('/add-to-basket/confirm', [OrdersController::class, 'confirmAddToBasket'])->name('add.to.basket.confirm');
    Route::post('/cancel-add-to-basket', [OrdersController::class, 'cancelAddToBasket'])->name('cancel.add.to.basket');
    Route::post('/sent', [OrdersController::class, 'sent'])->name('sent');
    Route::post('/received', [OrdersController::class, 'received'])->name('received');
    Route::post('/confirm-order', [OrdersController::class, 'confirmOrder'])->name('confirmOrder');

    // Events join/leave
    Route::post('/events/{event}/join', [EventsController::class, 'join'])->name('events.join');
    Route::post('/events/{event}/leave', [EventsController::class, 'leave'])->name('events.leave');

    // Messages
    Route::get('/dashboard/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/dashboard/messages/new/{userId}', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/dashboard/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/dashboard/messages/{id}', [MessageController::class, 'show'])->name('messages.show');

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard/admin-panel', [ProfileController::class, 'adminPanel'])->name('adminPanel');
        Route::get('/dashboard/admin', [ProfileController::class, 'adminPanel'])->name('admin.panel');
        Route::post('/admin/update/{entityType}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('/admin/updateStatus/{artworkId}', [AdminController::class, 'updateArtworkStatus'])->name('admin.updateStatus');
        Route::delete('/admin/delete/{entityType}/{id}', [AdminController::class, 'delete'])->name('admin.delete');
        Route::post('/admin/create/user', [UserController::class, 'create'])->name('admin.create.user');
        Route::post('/admin/create/artist', [ArtistsController::class, 'create'])->name('admin.create.artist');
        Route::post('/admin/create/artwork', [ArtworkController::class, 'createArtwork'])->name('admin.create.artwork');
        Route::post('/dashboard/delete-users', [UserController::class, 'deleteSelectedUsers'])->name('delete.users');
        Route::post('/assign-role/{userId}', [UserController::class, 'assignTheRole'])->name('assign.the.role');
    });
});

// Public routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/artwork/{id}', [ArtworkController::class, 'viewOne'])->name('home.artwork');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/searchList', [SearchController::class, 'searchList'])->name('searchList');

Route::get('user/{username}/profile', [UserController::class, 'showProfile'])->name('user.profile');
Route::get('user/{username}/gallery', [UserController::class, 'showGallery'])->name('user.gallery');
Route::get('user/{username}/shop', [UserController::class, 'showShop'])->name('user.shop');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

require __DIR__ . '/auth.php';
