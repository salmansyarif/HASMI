<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IntisariController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\IntisariController as AdminIntisariController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\BeritaTerkiniController as AdminBeritaTerkiniController;
use App\Http\Controllers\BeritaTerkiniController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Frontend - User)
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

/*
|--------------------------------------------------------------------------
| MATERI ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('materi')->name('materi.')->group(function () {
    Route::get('/', [MateriController::class, 'index'])->name('index');
    Route::get('/{categorySlug}/sub/{subCategorySlug}', [MateriController::class, 'showSubCategory'])->name('sub-category');
    Route::get('/{categorySlug}', [MateriController::class, 'show'])->name('show');
    Route::get('/{categorySlug}/{articleSlug}', [MateriController::class, 'detail'])->name('detail');
});

/*
|--------------------------------------------------------------------------
| PROGRAM ROUTES (Frontend - 3 Model System)
|--------------------------------------------------------------------------
*/
Route::prefix('program')->name('program.')->group(function () {

    // 1. Index - Semua kategori program
    Route::get('/', [ProgramController::class, 'index'])->name('index');

    // 2. Subcategory - Daftar program dalam subcategory (HARUS di atas route category)
    // Format: /program/hasmi-peduli/tebar-pangan
    Route::get('/{categorySlug}/{subcategorySlug}', [ProgramController::class, 'subcategory'])
        ->name('subcategory');

    // 3. Category - Tampilkan subcategories atau programs langsung
    // Format: /program/hasmi-peduli
    Route::get('/{categorySlug}', [ProgramController::class, 'category'])
        ->name('category');
});

// 4. Detail Program Individual
// Format: /program-detail/bantuan-pangan-ramadhan
Route::get('/program-detail/{slug}', [ProgramController::class, 'show'])->name('program.show');

// Program HASMI (Static Page)
Route::get('/program-hasmi', [ProgramController::class, 'programHasmi'])->name('program-hasmi');

/*
|--------------------------------------------------------------------------
| INTISARI ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('intisari')->name('intisari.')->group(function () {
    Route::get('/', [IntisariController::class, 'index'])->name('index');
    Route::get('/{slug}', [IntisariController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| KEGIATAN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::get('/', [KegiatanController::class, 'index'])->name('index');
    Route::get('/{slug}', [KegiatanController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| BERITA TERKINI ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('berita-terkini')->name('berita-terkini.')->group(function () {
    Route::get('/', [BeritaTerkiniController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaTerkiniController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| COMMENT ROUTE (Untuk Materi, Program, dll)
|--------------------------------------------------------------------------
*/
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register (jika ada)
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return redirect()->route('admin.articles.index');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ARTICLES (Materi)
    |--------------------------------------------------------------------------
    */
    Route::resource('articles', AdminArticleController::class);
    Route::delete('articles/{article}/thumbnail', [AdminArticleController::class, 'removeThumbnail'])
        ->name('articles.thumbnail.destroy');
    Route::get('articles/sub-categories/{categoryId}', [AdminArticleController::class, 'getSubCategories'])
        ->name('articles.sub-categories');

    /*
    |--------------------------------------------------------------------------
    | PROGRAMS
    |--------------------------------------------------------------------------
    */
    // AJAX: Get Subcategories by Category ID
    Route::get('programs/subcategories', [AdminProgramController::class, 'getSubcategories'])
        ->name('programs.subcategories');

    /*
    |--------------------------------------------------------------------------
    | PROGRAMS
    |--------------------------------------------------------------------------
    */
    Route::resource('programs', AdminProgramController::class);
    
    // Delete Photo
    Route::post('programs/{program}/photo/delete', [AdminProgramController::class, 'deletePhoto'])
        ->name('programs.photo.delete');
    
    // Delete Video
    Route::delete('programs/{program}/video', [AdminProgramController::class, 'deleteVideo'])
        ->name('programs.video.delete');
    
    // Update Position (Drag & Drop - optional)
    Route::post('programs/update-position', [AdminProgramController::class, 'updatePosition'])
        ->name('programs.update-position');

    /*
    |--------------------------------------------------------------------------
    | INTISARI
    |--------------------------------------------------------------------------
    */
    Route::resource('intisari', AdminIntisariController::class);

    /*
    |--------------------------------------------------------------------------
    | KEGIATAN
    |--------------------------------------------------------------------------
    */
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::post('kegiatan/{kegiatan}/photo/delete', [AdminKegiatanController::class, 'deletePhoto'])
        ->name('kegiatan.photo.delete');
    Route::post('kegiatan/{kegiatan}/thumbnail', [AdminKegiatanController::class, 'setThumbnail'])
        ->name('kegiatan.thumbnail.update');

    /*
    |--------------------------------------------------------------------------
    | BERITA TERKINI
    |--------------------------------------------------------------------------
    */
    Route::resource('berita-terkini', AdminBeritaTerkiniController::class);
    Route::post('berita-terkini/{berita_terkini}/photo/delete', [AdminBeritaTerkiniController::class, 'deletePhoto'])
        ->name('berita-terkini.photo.delete');

    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAGEMENT (USERS)
    |--------------------------------------------------------------------------
    */
    Route::resource('admins', \App\Http\Controllers\Admin\AdminManagementController::class)->names([
        'index' => 'admins.index',
        'create' => 'admins.create',
        'store' => 'admins.store',
        'edit' => 'admins.edit',
        'update' => 'admins.update',
        'destroy' => 'admins.destroy',
    ]);

    /*
    |--------------------------------------------------------------------------
    | COMMENTS (Moderasi Komentar)
    |--------------------------------------------------------------------------
    */
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [AdminCommentController::class, 'index'])->name('index');
        Route::post('/{id}/approve', [AdminCommentController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminCommentController::class, 'reject'])->name('reject');
        Route::delete('/{id}', [AdminCommentController::class, 'destroy'])->name('destroy');
    });
});