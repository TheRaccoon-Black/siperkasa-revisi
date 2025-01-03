<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\DigitalSignatureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('landing');
// });
Route::get('//qrLogin', function () {
    return view('qrLogin');
})->name('qrLogin');

Route::get('/', [Controller::class, 'landing']);
Route::get('/signatures/{link}', [DigitalSignatureController::class, 'showSignatureForm'])->name('signatures.form');
Route::post('/signatures/{link}', [DigitalSignatureController::class, 'saveSignature'])->name('signatures.save');
Route::get('/signatures/success/{link}', [DigitalSignatureController::class, 'success'])->name('signatures.success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/view-pdf', [PemeriksaanController::class, 'showpdf'])->name('view.showpdf');
    Route::get('/login-logs', [LoginLogController::class, 'index'])->name('login-logs.index');

    Route::get('/signatures/{id_hasil}/show', [DigitalSignatureController::class, 'showSignatureLinks'])->name('signatures.showLinks');

});


//admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/', [PetugasController::class, 'index'])->name('index');
        Route::get('/create', [PetugasController::class, 'create'])->name('create');
        Route::post('/', [PetugasController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PetugasController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PetugasController::class, 'update'])->name('update');
        Route::delete('/{id}', [PetugasController::class, 'destroy'])->name('destroy');
        Route::get('/user', [PetugasController::class, 'user'])->name('user');
        Route::put('/user/{id}', [PetugasController::class, 'updateUser'])->name('updateUser');
        Route::delete('/user/{id}', [PetugasController::class, 'destroyUser'])->name('destroyUser');
        Route::post('/user', [PetugasController::class, 'storeUser'])->name('storeUser');
    });

    // --------------------------------------------------------------------------
    // Checklist Routes
    // --------------------------------------------------------------------------
    Route::prefix('checklist')->name('checklist.')->group(function () {
        Route::get('/', [ChecklistController::class, 'index'])->name('index');
        Route::get('/create', [ChecklistController::class, 'create'])->name('create');
        Route::post('/', [ChecklistController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ChecklistController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ChecklistController::class, 'update'])->name('update');
        Route::delete('/{id}', [ChecklistController::class, 'destroy'])->name('destroy');
    });
    // --------------------------------------------------------------------------
    // Kendaraan Routes
    // --------------------------------------------------------------------------
    Route::prefix('kendaraan')->name('kendaraan.')->group(function () {
        Route::get('/', [KendaraanController::class, 'index'])->name('index');
        Route::get('/create', [KendaraanController::class, 'create'])->name('create');
        Route::post('/', [KendaraanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KendaraanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KendaraanController::class, 'update'])->name('update');
        Route::delete('/{id}', [KendaraanController::class, 'destroy'])->name('destroy');
    });
});

Route::get('pemeriksaan/cetak/{id_hasil}', [PemeriksaanController::class, 'cetak'])->name('pemeriksaan.cetak');

//admin routes
Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::prefix("pemeriksaan")->name("pemeriksaan.")->group(function () {
        Route::get("/", [PemeriksaanController::class, "index"])->name("index");
        Route::get('/create', [PemeriksaanController::class, 'create'])->name('create');
        Route::post('/store', [PemeriksaanController::class, 'store'])->name('store');
        Route::get('/rekap', [PemeriksaanController::class, 'recap'])->name('recap');
        Route::get('/arsip/{id_hasil}', [PemeriksaanController::class, 'arsip'])->name('arsip');
        Route::get('/fetch', [PemeriksaanController::class, 'fetch'])->name('fetch');
    });
});





require __DIR__ . '/auth.php';
