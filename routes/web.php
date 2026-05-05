<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Website\HomeController;
use App\Livewire\Roles;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\VerifyEmailController;
use GuzzleHttp\Psr7\Request;
use Livewire\Volt\Volt;
use Ramsey\Collection\Set;

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    return view('test');
});
Route::post('/test-submit',function(){
    return request()->all();
})->name('test.submit');
Route::post('/upload_by_file', [HomeController::class, 'uploadByFile'])->name('upload_by_file');
Route::post('/upload_by_url', [HomeController::class, 'uploadByUrl'])->name('upload_by_url');
// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Demo single post (example)
Route::get('/single-post', [HomeController::class, 'singlePostDemo'])->name('post');




Route::get('/optimize', function () {
    // Simple security check with a secret key
    // if (request()->get('key') !== env('MAINTENANCE_KEY')) {
    //     abort(403, 'Unauthorized');
    // }

    // Run optimization & clear caches
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:clear');

    return '✅ Application optimized and caches cleared!';
});



Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('debug', function () {
    return response()->json([
        'public_path'   => public_path(),
        'storage_path'  => storage_path(),
        'app_path'      => app_path(),
        'base_path'     => base_path(),
        'cwd'           => getcwd(),
        'assets_path'   => asset(''),
    ]);
});

route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
        Route::get('/roles', function () {
            return view('admin.roles');
        })->name('roles');
        Route::get('/users', function () {
            return view('admin.users');
        })->name('users');
        Route::get('/authors',[AuthorController::class, 'author'])->name('authors');
        //roles

        Route::get('/roles/create', [RolesController::class, 'createRoleForm'])->name('roles.create');
        Route::post('/roles/store', [RolesController::class, 'createRole'])->name('roles.store');
        Route::get('/roles/edit/{id}', [RolesController::class, 'editRole'])->name('roles.edit');
        Route::put('/roles/update/{id}', [RolesController::class, 'updateRole'])->name('roles.update');

        //Category
        Route::get('/categories', [CategoryController::class, 'categoryList'])->name('category.list');

        //menu
        Route::get('/menus',[MenuController::class,'menuList'])->name('menu.list');
        Route::get('/main-menus',[MenuController::class,'mainMenuList'])->name('mainmenu.list');
        Route::get('/menu-list',[MenuController::class,'allMenuList'])->name('allmenu.list');
        //Posts
        Route::get('/posts', [PostController::class, 'postList'])->name('post.list');
        Route::get('/posts/create', [PostController::class, 'createPostForm'])->name('post.create');
        Route::post('/posts/store', [PostController::class, 'createPost'])->name('post.store');
        Route::get('/posts/edit/{id}', [PostController::class, 'editPost'])->name('post.edit');
        Route::put('/posts/update/{id}', [PostController::class, 'updatePost'])->name('post.update');
        Route::delete('/posts/delete/{id}', [PostController::class, 'deletePost'])->name('post.delete');

        //video posts
        Route::get('/video-posts', [PostController::class, 'videoPostList'])->name('video.post.list');
        Route::get('/video-posts/create', [PostController::class, 'videoPostCreate'])->name('video.post.create');
        Route::post('/video-posts/store', [PostController::class, 'videoPostStore'])->name('video.post.store');
        Route::get('/video-posts/edit/{id}', [PostController::class, 'videoPostEdit'])->name('video.post.edit');
        Route::put('/video-posts/update/{id}', [PostController::class, ' videoPostUpdate'])->name('video.post.update');
        Route::delete('/video-posts/delete/{id}', [PostController::class, 'videoPostDelete'])->name('video.post.delete');

        //user profile
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/account-settings', [UserController::class, 'accountSettings'])->name('account.settings');
        Route::get('/optimize', function () {
            Artisan::call('optimize');
            return "Application optimized successfully!";
        });

        //ads
        Route::get('/ads', [AdController::class, 'index'])->name('ads');
        Route::get('/ads/edit/{id}', [AdController::class, 'edit'])->name('ads.edit');

        //settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::get('/settings/general',[SettingController::class, 'general'])->name('settings.general');
        Route::get('/settings/social',[SettingController::class, 'social'])->name('settings.social');
        Route::get('/clear-cache', function () {
            Artisan::call('optimize:clear');
            return "Cache cleared successfully!";
        });

        Route::get('/migrate', function () {
            Artisan::call('migrate', ['--force' => true]);
            return "Migration completed successfully!";
        });

    });
// Category page
Route::get('/posts/recent', [HomeController::class, 'recentPosts'])->name('recent.post.list');

// Post inside category
Route::get('/category/{category}/{slug}', [HomeController::class, 'postShow'])->name('post.show');
// Route::get('/{slug}', [HomeController::class,'singlePost'])->name('singlepost');

Route::get('/category/{category}', [HomeController::class, 'categoryPost'])->name('category');

//video posts
Route::get('/news/videos', [HomeController::class, 'videosList'])->name('video.post.list');
Route::get('/news/shorts', [HomeController::class, 'videoShortsSelect'])->name('video.post.shorts');
Route::get('/news/videos/{slug}', [HomeController::class, 'videoPostShow'])->name('video.post.show');
Route::get('/news/shorts/{slug}', [HomeController::class, 'videoShortsShow'])->name('video.post.shorts.show');

