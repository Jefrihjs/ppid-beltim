<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Public\InformationController;
use App\Http\Controllers\Admin\InformationManagerController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [PublicController::class, 'index'])->name('home');

// Route untuk halaman Galeri Foto (Semua Foto)
Route::get('/galeri-kegiatan', [PublicController::class, 'gallery'])->name('public.gallery');

// Route untuk Pengumuman & Prosedur
Route::get('/pengumuman-prosedur', [PublicController::class, 'prosedur'])->name('public.prosedur');

// Daftar Informasi
Route::prefix('informasi-publik')->group(function () {
    Route::get('/dip-utama', [PublicController::class, 'dipUtama'])->name('informasi.utama');
    Route::get('/dip-pembantu', [PublicController::class, 'dipPembantu'])->name('informasi.pembantu');
    Route::get('/dip-berkala', [PublicController::class, 'dipBerkala'])->name('informasi.berkala');
    Route::get('/dip-setiap-saat', [PublicController::class, 'dipSetiapSaat'])->name('informasi.setiap_saat');
    Route::get('/dip-serta-merta', [PublicController::class, 'dipSertaMerta'])->name('informasi.serta_merta');
});

// Layanan
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/', fn() => view('public.layanan'))->name('index');
    Route::get('/permohonan', fn() => view('public.layanan.permohonan'))->name('permohonan');
    Route::get('/keberatan', fn() => view('public.layanan.keberatan'))->name('keberatan');
    Route::get('/penyelesaian-sengketa', fn() => view('public.layanan.sengketa'))->name('sengketa');
    Route::get('/waktu-biaya', fn() => view('public.layanan.waktu'))->name('waktu');
});

Route::get('/permohonan-informasi', function () {
    return view('public.permohonan_informasi');
})->name('permohonan.informasi');

Route::get('/pengajuan-keberatan', function () {
    return view('public.pengajuan_keberatan');
})->name('keberatan.form');

Route::get('/penyelesaian-sengketa', function () {
    return view('public.penyelesaian_sengketa');
})->name('sengketa.form');

// Permohonan Informasi
Route::get('/permohonan', [PermohonanController::class, 'create'])->name('permohonan.create');
Route::post('/permohonan', [PermohonanController::class, 'store'])->name('permohonan.store');

Route::get('/permohonan-sukses', fn() => view('public.permohonan_sukses'))->name('permohonan.sukses');

// Monitoring
Route::get('/monitoring', [PermohonanController::class, 'monitoringForm'])->name('monitoring.form');
Route::post('/monitoring', [PermohonanController::class, 'monitoringCheck'])->name('monitoring.check');

// Kontak (Public Submit)
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');
Route::get('/kontak', fn() => view('public.kontak'))->name('kontak');

// Kebijakan Privasi

Route::get('/kebijakan-privasi', [PublicController::class, 'privacyPolicy'])->name('privacy.policy');

// Profil Public
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [ProfilController::class, 'tentang'])->name('tentang');
    Route::get('/maklumat', [ProfilController::class, 'maklumat'])->name('maklumat');
    Route::get('/struktur', [ProfilController::class, 'struktur'])->name('struktur');
    Route::get('/visi', [ProfilController::class, 'visi'])->name('visi');
});

// Area publik
Route::get('/syarat-ketentuan', [PublicController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/informasi-publik', [InformationController::class, 'index'])->name('public.informasi.index');
Route::get('/informasi/{id}', [App\Http\Controllers\Public\InformationController::class, 'show'])->name('public.informasi.show');
// Rute untuk menghitung unduhan sebelum ke link asli
Route::get('/informasi/download/{id}', [App\Http\Controllers\Public\InformationController::class, 'download'])->name('public.informasi.download');
/*
|--------------------------------------------------------------------------
| ADMIN AREA (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.') // Nama route otomatis diawali 'admin.'
    ->group(function () {

    // Route Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // PENGATURAN HERO (Cukup Pakai Resource Ini Saja)
    // Ini otomatis membuat route: admin.hero.index, admin.hero.create, admin.hero.store, dll.
    Route::resource('hero', HeroController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('video', VideoController::class);
    Route::resource('announcement', AnnouncementController::class);

    // Permohonan
    Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/{id}', [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::post('/permohonan/{id}/update-status', [PermohonanController::class, 'updateStatus'])->name('permohonan.update');
    Route::get('/permohonan/cetak/laporan', [PermohonanController::class, 'cetakLaporan'])->name('permohonan.cetak');

    // Pesan Kontak
    Route::get('/pesan', [ContactMessageController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{contactMessage}', [ContactMessageController::class, 'show'])->name('pesan.show');

    // Route Resource untuk CRUD Informasi Publik
    Route::resource('informasi', InformationManagerController::class);

    Route::resource('opd', OpdController::class)->except(['destroy', 'show', 'create']);

    Route::resource('opd', App\Http\Controllers\Admin\OpdController::class)->only(['index', 'store', 'update']);
});

/*
|--------------------------------------------------------------------------
| PROFILE (BREEZE DEFAULT)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';