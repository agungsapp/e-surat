<?php

use App\Http\Controllers\DebugController;
use App\Http\Controllers\QRCodeController;
use App\Livewire\Admin\BannerPage;
use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\DataSuratPage;
use App\Livewire\Admin\PendudukPage;
use App\Livewire\Admin\PermohonanPage;
use App\Livewire\Admin\RejectPermohonanPage;
use App\Livewire\Admin\SuratInfoPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\User\UserCardPelayananSuratPage;
use App\Livewire\User\UserCekStatusPage;
use App\Livewire\User\UserEditPermohonanPage;
use App\Livewire\User\UserHomePage;
use App\Livewire\User\UserKontakPage;
use App\Livewire\User\UserPanduanPage;
use App\Livewire\User\UserPelayananSuratPage;
use App\Livewire\User\UserPengajuanSuratPage;
use App\Livewire\User\UserTentangPage;
use App\Livewire\User\UserVerifyDocumentPage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('livewire.user.layouts.app');
    if (Auth::check()) {
        # code...
        return redirect()->to(route('admin.dashboard'));
    }
    return redirect()->to('/home');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/generate-qrcode', [QRCodeController::class, 'generate']);

Route::get('test', function () {
    return view('surat.sku');
});
Route::get('/debug-pdf/{id}', [DebugController::class, 'showPdf'])->name('debug.pdf');

Route::get('home', UserHomePage::class)->name('home');
Route::get('pelayanan-surat', UserCardPelayananSuratPage::class)->name('pelayanan-surat');
Route::get('pengajuan-surat/{id}', UserPengajuanSuratPage::class)->name('pengajuan-surat');
Route::get('edit-permohonan/{id}', UserEditPermohonanPage::class)->name('edit-permohonan');

Route::get('verify-document/{id}', UserVerifyDocumentPage::class)->name('verify-document');
Route::get('cek-status', UserCekStatusPage::class)->name('cek-status');
Route::get('tentang', UserTentangPage::class)->name('tentang');
Route::get('panduan', UserPanduanPage::class)->name('panduan');
Route::get('kontak', UserKontakPage::class)->name('kontak');


// Route::get('login', LoginPage::class)->name('login');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
    Route::get('permohonan', PermohonanPage::class)->name('permohonan');
    Route::get('reject-permohonan/{id}', RejectPermohonanPage::class)->name('reject-permohonan');
    Route::get('data-surat', DataSuratPage::class)->name('data-surat');
    Route::get('surat-info/{id}', SuratInfoPage::class)->name('surat-info');

    Route::get('penduduk', PendudukPage::class)->name('penduduk');

    Route::get('banner', BannerPage::class)->name('banner');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});



Route::get('generate-storage', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});
Route::get('migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Migrate fresh dan seeder berhasil dijalankan!';
});

require __DIR__ . '/auth.php';
