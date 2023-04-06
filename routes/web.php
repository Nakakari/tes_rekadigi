<?php

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleAssignmentController;
use App\Http\Controllers\Komentar\KomentarController;
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

// GOOGLE AUTENTIKASI
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// CHOOSE ROLE
Route::get('choose_role', [LoginController::class, 'chooseRole'])->name('pilih_role');

// LANDING PAGES
Route::get('/', [BerandaController::class, 'landing']);
Route::get('/activities', [HomeController::class, 'activities']);
Route::get('/activities/{kategori}', [HomeController::class, 'activities_category']);
Route::get('/activities/search', [HomeController::class, 'activities_search']);
Route::get('/activities/{id}/{judul}', [HomeController::class, 'activities_page']);

Route::get('/news', [HomeController::class, 'news']);
Route::get('/news/kategori/{kategori}', [HomeController::class, 'news_category']);
Route::get('/news/{id}/{judul}', [HomeController::class, 'news_page']);
Route::get('/news/search', [HomeController::class, 'news_search']);

// Un-active user page
Route::get('/tidak_aktif', function () {
    return view('dashboards.users.layouts.tidak_aktif');
})->name('tidak_aktif');
Route::get('/logout', function () {
    return view('welcome');
});

//Login Page
Route::get('/login', function () {
    return view('auth.login');
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::group(['prefix' => 'sv', 'middleware' =>  ['IsProdi', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', [ProdiController::class, 'index'])->name('sv.dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // CHANGE ROLE
    Route::post('/pergantian', [ProfilController::class, 'ganti']);

    // ROLES
    Route::get('/getall', [RoleController::class, 'getIndex'])->name('getall');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles_create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles_store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles_edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles_update/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles_destroy/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // USER
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/isaktif', [UserController::class, 'isAktif']);
    Route::get('/user/create', [UserController::class, 'add']);
    Route::post('/user/create', [UserController::class, 'processAdd']);
    Route::get('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/update/{user}', [UserController::class, 'processUpdate'])->name('user.processUpdate');
    Route::get('/user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('roles/detail/{user}', [UserController::class, 'show'])->name('user.detail');

    // PROFIL
    Route::get('/profil', [ProfilController::class, 'profil']);
    Route::post('/profil/update/{id}', [ProfilController::class, 'editprofil'])->name('profil.update');
    Route::post('/profil/changepassword/{id}', [ProfilController::class, 'editpassword'])->name('profil.changepassword');
    Route::get('/profile/createmitra', [ProfilController::class, 'CreateMitra'])->name('profil_create_mitra');
    Route::post('/profile/createmitra', [ProfilController::class, 'ProcessCreateMitra']);
    Route::post('/profile/editmitra/{id}', [ProfilController::class, 'ProcessEditMitra']);
    // ---MENU UTAMA--- //

    //role_Assignment
    Route::post('/role_ass/create', [RoleAssignmentController::class, 'store']);
    Route::post('/role_assignment/update/{user}', [RoleAssignmentController::class, 'processUpdate']);
    Route::get('/role_assignment/delete/{user}', [RoleAssignmentController::class, 'delete']);

    // Berita
    Route::get('/berita', [BeritaController::class, 'index']);
    Route::get('/berita/addNew', [BeritaController::class, 'AddNew']);
    Route::post('/berita/addNew/create', [BeritaController::class, 'create']);
    Route::get('/berita/edit/{id}', [BeritaController::class, 'Edit']);
    Route::post('/berita/edit/process/{id}', [BeritaController::class, 'UpdateProcess']);
    Route::get('/berita/active', [BeritaController::class, 'isAktif']);
    Route::get('/berita/delete/{id}', [BeritaController::class, 'delete']);
    Route::get('/berita/thumbnail/{id}', [BeritaController::class, 'thumbnail']);
    Route::post('/berita/addThumbnail/{id}', [BeritaController::class, 'addThumbnail']);
    Route::get('/berita/detail/{id}', [BeritaController::class, 'detail']);
    Route::get('/berita/komentar/{id}', [KomentarController::class, 'index']);
    Route::post('/berita/komentar/store', [KomentarController::class, 'store'])->name('comment.store');
    Route::post('/berita/komentar-reply/store', [KomentarController::class, 'replyStore'])->name('reply.store');
    Route::get('/komentar/isaktif', [KomentarController::class, 'isAktif']);
    Route::get('/berita/delete_pic/{id}', [BeritaController::class, 'delete_gambar']);

    // Kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index']);
    Route::get('/kegiatan/addNew', [KegiatanController::class, 'AddNew']);
    Route::post('/kegiatan/addNew/create', [KegiatanController::class, 'create']);
    Route::get('/kegiatan/edit/{id}', [KegiatanController::class, 'Edit']);
    Route::post('/kegiatan/edit/process/{id}', [KegiatanController::class, 'UpdateProcess']);
    Route::get('/kegiatan/active', [KegiatanController::class, 'isAktif']);
    Route::get('/kegiatan/delete/{id}', [KegiatanController::class, 'delete']);
    Route::get('/kegiatan/thumbnail/{id}', [KegiatanController::class, 'thumbnail']);
    Route::post('/kegiatan/addThumbnail/{id}', [KegiatanController::class, 'addThumbnail']);
    Route::get('/kegiatan/detail/{id}', [KegiatanController::class, 'detail']);
    Route::get('/kegiatan/komentar/{id}', [KomentarController::class, 'index_kegiatan']);
    Route::post('/kegiatan/komentar/store', [KomentarController::class, 'store_kegiatan'])->name('kegiatan.comment.store');
    Route::post('/kegiatan/komentar-reply/store', [KomentarController::class, 'replyStore_kegiatan'])->name('kegiatan.reply.store');
    Route::get('/kegiatab/delete_pic/{id}', [KegiatanController::class, 'delete_gambar']);


    // KATEGORI
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/addNew', [KategoriController::class, 'AddNew']);
    Route::post('/kategori/addNew/create', [KategoriController::class, 'create']);
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'Edit']);
    Route::post('/kategori/edit/process/{id}', [KategoriController::class, 'UpdateProcess']);
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

    // BERANDA
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::post('/beranda/edit/beranda', [BerandaController::class, 'process_beranda']);
    Route::post('/beranda/edit/kegiatan', [BerandaController::class, 'process_kegiatan']);
    Route::post('/beranda/edit/mitra', [BerandaController::class, 'process_mitra']);
    Route::post('/beranda/edit/berita', [BerandaController::class, 'process_berita']);
});
