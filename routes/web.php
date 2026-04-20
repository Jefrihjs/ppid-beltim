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

Route::get('/informasi/uji-konsekuensi', function () {
    return view('public.informasi.konsekuensi');
})->name('informasi.konsekuensi');

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

// Monitoring (Baris 64 sudah diperbaiki)
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
Route::get('/pencarian', [App\Http\Controllers\PublicController::class, 'search'])->name('public.search');
Route::get('/informasi/download/{id}', [App\Http\Controllers\Public\InformationController::class, 'download'])->name('public.informasi.download');
Route::get('/permohonan/cetak-bukti/{kode}', [PermohonanController::class, 'cetakBukti'])->name('permohonan.cetak_bukti');

/*
|--------------------------------------------------------------------------
| ADMIN AREA (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.') 
    ->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // --- DROPDOWN LAYANAN PPID ---
    Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/{id}', [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::post('/permohonan/{id}/pemberitahuan', [PermohonanController::class, 'storePemberitahuan'])->name('permohonan.pemberitahuan');
    Route::post('/permohonan/{id}/update-status', [PermohonanController::class, 'updateStatus'])->name('permohonan.update');
    Route::delete('/permohonan/{id}', [App\Http\Controllers\PermohonanController::class, 'destroy'])->name('permohonan.destroy');
    Route::get('/permohonan/cetak/laporan', [PermohonanController::class, 'cetakLaporan'])->name('permohonan.cetak');
    Route::get('/laporan/cetak-semua', [App\Http\Controllers\Admin\LaporanController::class, 'cetakSemua'])->name('admin.laporan.cetak');
    Route::get('/laporan/cetak', [App\Http\Controllers\Admin\LaporanController::class, 'cetakSemua'])->name('laporan.cetak');

    Route::get('/keberatan', [App\Http\Controllers\Admin\KeberatanController::class, 'index'])->name('keberatan.index');
    Route::get('/keberatan/{id}', [PermohonanController::class, 'showKeberatan'])->name('keberatan.show');
    Route::post('/permohonan/{id}/keberatan', [PermohonanController::class, 'storeKeberatan'])->name('permohonan.keberatan.store');

    Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');

    Route::resource('hero', HeroController::class);
    Route::resource('gallery', GalleryController::class);
    Route::post('/gallery-video', [GalleryController::class, 'storeVideo'])->name('gallery.storeVideo');
    Route::delete('/gallery-video/{video}', [GalleryController::class, 'destroyVideo'])->name('gallery.destroyVideo');
    Route::resource('announcement', AnnouncementController::class);
    Route::resource('informasi', InformationManagerController::class);
    Route::resource('opd', App\Http\Controllers\Admin\OpdController::class)->only(['index', 'store', 'update']);

    Route::get('/pesan', [ContactMessageController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{contactMessage}', [ContactMessageController::class, 'show'])->name('pesan.show');
    Route::delete('/pesan/{id}', [ContactMessageController::class, 'destroy'])->name('pesan.destroy');

    Route::post('/permohonan/{id}/tidak-lengkap', [App\Http\Controllers\PermohonanController::class, 'tidakLengkap'])->name('permohonan.tidak_lengkap');
    Route::get('/permohonan/{id}/cetak-pemberitahuan', [PermohonanController::class, 'cetakPemberitahuan'])->name('permohonan.cetak_pemberitahuan');
    Route::get('/permohonan/{id}/cetak-penolakan', [PermohonanController::class, 'cetakPenolakan'])->name('permohonan.cetak_penolakan');
    Route::post('/permohonan/{id}/upload-selesai', [PermohonanController::class, 'uploadSelesai'])->name('permohonan.upload_selesai');

    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/visitors', [App\Http\Controllers\Admin\VisitorController::class, 'index'])->name('visitors.index');
    Route::get('/visitors/pdf', [App\Http\Controllers\Admin\VisitorController::class, 'exportPdf'])->name('visitors.pdf');
});

/*
|--------------------------------------------------------------------------
| PROFILE & USER MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['checkRole:superadmin'])->group(function () {
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        });
});

require __DIR__.'/auth.php';