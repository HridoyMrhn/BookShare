<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PublisherController;
use App\Http\Controllers\Frontend\FrontBookController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminResetPasswordController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ContactController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

// ================= All Frontend Controller =================
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about-us', [FrontController::class, 'about'])->name('about');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact');
Route::get('category/{category_slug}', [FrontController::class, 'category'])->name('category');
Route::get('profile/{user_name}', [FrontController::class, 'profile'])->name('user.profile');

Route::post('contact/store', [ContactController::class, 'store'])->name('store.contact');

// Dashboard Controller
Route::prefix('dashboard')->group(function() {
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/update/{id}', [UserController::class, 'dashboardUpdate'])->name('user.dashboard.update');
    Route::get('/my-books', [UserController::class, 'dashboardBookUploads'])->name('user.dashboard.book.upload');
    Route::get('/my-order', [UserController::class, 'dashboardBookOrders'])->name('user.dashboard.book.order');
    Route::get('/book-request', [UserController::class, 'dashboardBookRequest'])->name('user.dashboard.book.request');
});

// Book Controller
Route::get('all-book', [FrontBookController::class, 'bookList'])->name('user.book.list');
Route::get('add-book', [FrontBookController::class, 'bookCreate'])->name('user.book.create');
Route::post('books-store', [FrontBookController::class, 'bookStore'])->name('user.book.store');
Route::get('books-details/{slug}', [FrontBookController::class, 'bookDetails'])->name('user.book.details');
// Route::get('books/details', [FrontBookController::class, 'bookStore'])->name('user.book.store');
// Route::get('book/add', [FrontBookController::class, 'bookCreate'])->name('user.book.create');
Route::get('books-edit/{slug}', [FrontBookController::class, 'bookEdit'])->name('user.book.edit');
Route::post('books-update/{id}', [FrontBookController::class, 'bookUpdate'])->name('user.book.update');
Route::get('books-delete/{slug}', [FrontBookController::class, 'bookDelete'])->name('user.book.delete');
Route::get('book-search', [FrontBookController::class, 'bookSearch'])->name('user.book.search');
Route::get('advance-search', [FrontBookController::class, 'advanceSearch'])->name('advance.search');

// user book request route
Route::post('book-request/{slug}', [FrontBookController::class, 'bookRequest'])->name('book.request');
Route::post('book-request/update/{id}', [FrontBookController::class, 'bookRequestUpdate'])->name('book.request.update');
Route::get('book-request/cancel/{id}', [FrontBookController::class, 'bookRequestCancel'])->name('book.request.cancel');

// owner book approve route
Route::post('book-request/approve/{id}', [FrontBookController::class, 'bookRequestApprove'])->name('book.request.approve');
Route::post('book-request/unapprove/{id}', [FrontBookController::class, 'bookRequestUnapprove'])->name('book.request.unapprove');

// User book approve route
Route::post('book-order/approve/{id}', [FrontBookController::class, 'bookOrderApprove'])->name('book.order.approve');
Route::post('book-order/unapprove/{id}', [FrontBookController::class, 'bookOrderUnapprove'])->name('book.order.unapprove');

// Book Returns route
Route::get('book-return/request/{id}', [FrontBookController::class, 'bookReturnRequest'])->name('book.return.request');
Route::post('book-return/confirm/{id}', [FrontBookController::class, 'bookReturnConfirm'])->name('book.return.confirm');


// ================= All Backend Controller =================
Route::prefix('admin')->group(function() {

    // Admin Login Routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout/submit', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Password Email Send
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/resetPost', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    // Password Reset
    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.reset.post');

    // Middleware Routes
    Route::group(['middleware' => 'auth:admin'],function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('book', BookController::class);
        Route::post('book/approve/{id}', [BookController::class, 'bookApprove'])->name('book.approve');
        Route::post('book/unapprove/{id}', [BookController::class, 'bookUnapprove'])->name('book.unapprove');
        // Route::get('book/approved/', [BookController::class, 'bookApproveList'])->name('book.approve.list');
        Route::get('approved/book/', [BookController::class, 'bookApproveList'])->name('book.approve.list');
        // Route::get('book/unapproved', [BookController::class, 'bookUnapproveList'])->name('book.unapprove.list');
        Route::get('unapproved/book', [BookController::class, 'bookUnapproveList'])->name('book.unapprove.list');

        Route::resource('category', CategoryController::class);
        Route::resource('author', AuthorController::class);
        Route::resource('publisher', PublisherController::class);
        Route::resource('banner', BannerController::class);

        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    });

});
