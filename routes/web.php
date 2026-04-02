<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\CensoredWordController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/search-users', [ChatController::class, 'search'])->name('users.search');
    Route::get('/chat/{conversation}', [ChatController::class, 'show']);
    Route::post('/chat/message', [ChatController::class, 'sendMessage']);
    Route::post('/chat/start', [ChatController::class, 'startConversation']);
    Route::get('/api/user/{userId}', [ChatController::class, 'getUser']);

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/history', [PostController::class, 'history'])->name('posts.history');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'user'])->name('user');
    Route::get('reports', [AdminController::class, 'report'])->name('report');
    Route::get('censored-words', [AdminController::class, 'censoredWords'])->name('censored_words');

    Route::get('api/growth-data', [AdminController::class, 'getGrowthData'])->name('api.growth_data');

    Route::get('api/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::put('api/reports/{reportId}/resolve', [AdminReportController::class, 'resolve'])->name('reports.resolve');
    Route::put('api/reports/{postId}/approve', [AdminReportController::class, 'approve'])->name('reports.approve');
    Route::put('api/reports/{postId}/decline', [AdminReportController::class, 'decline'])->name('reports.decline');

    Route::get('api/censored-words', [CensoredWordController::class, 'index'])->name('censored_words.index');
    Route::post('api/censored-words', [CensoredWordController::class, 'store'])->name('censored_words.store');
    Route::delete('api/censored-words/{censored_word}', [CensoredWordController::class, 'destroy'])->name('censored_words.destroy');

    Route::get('api/users', [UserController::class, 'index'])->name('users.index');
    Route::put('api/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('api/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
