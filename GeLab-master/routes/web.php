<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use Auth;
use App\Http\Controllers\Website\RoutesController;
use App\Http\Controllers\Website\PagesController;
use App\Models\Post;
use \UniSharp\LaravelFilemanager\Lfm;


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



/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/



Route::get('/register', function() {
    return redirect('/login');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();


/*
|--------------------------------------------------------------------------
| Check if user is auth
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
	Lfm::routes();
});  
Route::middleware(['auth.check'])->group(function () {
	
   
    Route::get('/admin', [AdminController::class, 'index'] )->name('dashboard');
    
    //Profile ------------------------------------->
    Route::get('/admin/profile', [UsersController::class, 'editProfile'] )->name('asdasdsa');
    Route::post('/admin/profile', [UsersController::class, 'updateProfile'] );

    //Sections ------------------------------------->
    Route::get('/admin/sections', [SectionController::class, 'index'] )->name('section.list');
    


    //Banners -------------------------------------->
    Route::get('/admin/banners/{type}', [BannerController::class, 'index'] )->name('banner.list');
    Route::get('/admin/banners/{type}/create', [BannerController::class, 'create'] )->name('banner.create');
    Route::post('/admin/banners/{type}/create', [BannerController::class, 'store'] )->name('banner.store');
    Route::get('/admin/banners/{banner}/edit', [BannerController::class, 'edit'] )->name('banner.edit');
    Route::post('/admin/banners/{banner}/edit', [BannerController::class, 'update'] )->name('banner.update');
    Route::get('/admin/banners/{banner}/delete', [BannerController::class, 'destroy'] )->name('banner.destroy');
    




    
    // Admin\UploadFilesController
    Route::post('/admin/upload/image', [UploadFilesController::class, 'uploadImage'])->name('image.upload');
    Route::post('/admin/upload/image/delete', [UploadFilesController::class, 'deleteImage'])->name('image.del');
    Route::get('/admin/upload/image/delete', [UploadFilesController::class, 'clearChache'])->name('image.clear');
    


    //Post ------------------------------------->
    Route::get('/admin/section/{sec}/posts', [PostController::class, 'index'] )->name('post.list');
    Route::get('/admin/section/{sec}/posts/create', [PostController::class, 'create'] )->name('post.create');
    Route::post('/admin/section/{sec}/posts/create', [PostController::class, 'store'] )->name('post.store');
    Route::get('/admin/section/posts/{post}/edit', [PostController::class, 'edit'] )->name('post.edit');
    Route::post('/admin/section/posts/{post}/edit', [PostController::class, 'update'] )->name('post.update');
    Route::get('/admin/section/posts/{post}/delete', [PostController::class, 'destroy'] )->name('post.destroy');
});

/*
|--------------------------------------------------------------------------
| Check if user is SUPERUSER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.check', 'isSuperuser'])->group(function () {
    
    //Profile ------------------------------------->
    Route::get('/admin/users', [UsersController::class, 'index'] );
    Route::get('/admin/users/add', [UsersController::class, 'create'] );
    Route::post('/admin/users/add', [UsersController::class, 'store'] );
    Route::get('/admin/users/edit/{id}', [UsersController::class, 'edit'] );
    Route::get('/admin/users/logs/{id}', [UsersController::class, 'logs'] );
    Route::post('/admin/users/edit/{id}', [UsersController::class, 'update'] );
    Route::get('/admin/users/destroy/{id}', [UsersController::class, 'destroy'] );
});

/*
|--------------------------------------------------------------------------
| Check if user is Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.check', 'isAdmin'])->group(function () {

    //Sections ------------------------------------->
    Route::get('/admin/sections/create', [SectionController::class, 'create'] );
    Route::post('/admin/sections/create', [SectionController::class, 'store'] );
    Route::get('/admin/sections/edit/{id}', [SectionController::class, 'edit'] );
    Route::post('/admin/sections/edit/{id}', [SectionController::class, 'update'] );
    Route::get('/admin/sections/destroy/{id}', [SectionController::class, 'destroy'] );
    Route::post('/admin/sections/arrange', [SectionController::class, 'arrange'] );
    
    //Settings ---------------------------
    
    Route::get('/admin/settings/edit', [SettingsController::class, 'edit'] )->name('settings.edit');
    Route::post('/admin/settings/edit', [SettingsController::class, 'update'] )->name('settings.update');


	//Directory ---------------------------
	Route::get('/admin/directories/{type}', [DirectoryController::class, 'index'] )->name('directory.list');
    Route::get('/admin/directories/{type}/create', [DirectoryController::class, 'create'] )->name('directory.create');
    Route::post('/admin/directories/{type}/create', [DirectoryController::class, 'store'] )->name('directory.store');
    Route::get('/admin/directories/{directory}/edit', [DirectoryController::class, 'edit'] )->name('directory.edit');
    Route::post('/admin/directories/{directory}/edit', [DirectoryController::class, 'update'] )->name('directory.update');
    Route::get('/admin/directories/{directory}/delete', [DirectoryController::class, 'destroy'] )->name('directory.destroy');
    Route::post('/admin/directories/arrange', [DirectoryController::class, 'arrange'] );


    
    //Language ---------------------------
    
    Route::get('/admin/languages/edit', [LanguageController::class, 'edit'] )->name('languages.edit');
    Route::post('/admin/languages/edit', [LanguageController::class, 'update'] )->name('languages.update');

    //Language ---------------------------
    
    Route::get('/admin/submissions', [SubmissionController::class, 'index'] );
    Route::get('/admin/submission/{submission}', [SubmissionController::class, 'show'] );
    Route::get('/admin/submission/destroy/{submission}', [SubmissionController::class, 'destroy'] );

    
});

Route::post('/subscribe', [PagesController::class, 'subscribe']);
Route::post('/search', [PagesController::class, 'search']);
Route::any('/', [PagesController::class, 'homePage']);
Route::any('/{all}', [RoutesController::class, 'index'])->where('all', '.*');




