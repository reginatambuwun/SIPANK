<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    UserBkpsdmController,
    KriteriaController,
    BobotKriteriaController,
    SubKriteriaController,
    BobotSubkriteriaController,
    HitungKriteriaController,
    PeriodeNaikPangkatController,
    AlternatifController,
    RekomendasiController,
    PengajuanBerkasController,
    PeriodePegawaiController,
    PeriodeAlternatifController,
    PemberitahuanController,
    ProfilController,
    ArsipController
};
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
//     return view('home');
// });

////////////////////////////////////////////

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
    Route::post('/ubah-profil-user', [App\Http\Controllers\ProfilController::class, 'ubahProfilUser'])->name('ubah-profil-user');
    
    Route::get('pemberitahuan', [PemberitahuanController::class, 'index'])->name('pemberitahuan.index');
    Route::get('pemberitahuan/{id}/', [PemberitahuanController::class, 'detail'])->name('pemberitahuan.detail');

    // digunakan oleh admin & pegawai untuk update detail profil
    Route::patch('pengguna-update/{id}', [UserController::class, 'update'])->name('pengguna.update');
});

Route::group(['middleware' => ['auth','auth_admin']], function(){
    
    Route::resource('/pengguna', UserController::class)->except(['update']);
    Route::get('datatable-pengguna', [UserController::class, 'datatable'])->name('user.datatable');

    Route::resource('/pengguna-bkpsdm', UserBkpsdmController::class);
    Route::get('datatable-bkpsdm', [UserBkpsdmController::class, 'datatable'])->name('bkpsdm.datatable');
    
    // Route::resource('/kriteria', KriteriaController::class);
    // Route::get('datatable-kriteria', [KriteriaController::class, 'datatable'])->name('kriteria.datatable');
    
    // Route::resource('/bobot-kriteria', BobotKriteriaController::class);
    
    // Route::resource('/sub-kriteria', SubKriteriaController::class);
    // Route::get('datatable-sub-kriteria', [SubKriteriaController::class, 'datatable'])->name('sub-kriteria.datatable');
    
    // Route::get('bobot-sub-kriteria', [BobotSubkriteriaController::class, 'index'])->name('bobot-sub-kriteria.index');
    // Route::get('bobot-sub-kriteria/{id}', [BobotSubkriteriaController::class, 'edit'])->name('bobot-sub-kriteria.edit');
    // Route::post('bobot-sub-kriteria', [BobotSubkriteriaController::class, 'store'])->name('bobot-sub-kriteria.store');
    
    Route::get('hitung-kriteria', [HitungKriteriaController::class, 'index'])->name('hitung-kriteria.index');
    
    Route::resource('/periode', PeriodeNaikPangkatController::class);
    Route::get('datatable-periode', [PeriodeNaikPangkatController::class, 'datatable'])->name('periode.datatable');

    Route::get('alternatif/daftar-periode', [PeriodeNaikPangkatController::class, 'daftarPeriode'])->name('alternatif-daftar-periode.index');
    Route::get('alternatif/kelola/{id}', [AlternatifController::class, 'index'])->name('alternatif.index');
    Route::get('alternatif/tambah/{id}', [AlternatifController::class, 'create'])->name('alternatif.create');
    Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::get('alternatif/{id}', [AlternatifController::class, 'edit'])->name('alternatif.edit');
    Route::patch('alternatif/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
    Route::delete('alternatif/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

    Route::get('alternatif/kalkulasi/{userId}/{periodeId}', [AlternatifController::class, 'kalkulasi'])->name('alternatif.kalkulasi');

    // Route::get('rekomendasi/daftar-periode', [PeriodeNaikPangkatController::class, 'daftarPeriode'])->name('rekomendasi-daftar-periode.index');
    // Route::get('rekomendasi/kelola/{id}', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
    // Route::get('rekomendasi/kelola/{id}/edit', [RekomendasiController::class, 'edit'])->name('rekomendasi.edit');
    // Route::put('rekomendasi/kelola/{id}', [RekomendasiController::class, 'update'])->name('rekomendasi.update');
    // Route::get('datatable-rekomendasi/{id}', [RekomendasiController::class, 'datatable'])->name('rekomendasi.datatable');
});

Route::group(['middleware' => ['auth','auth_pegawai']], function(){
    Route::get('profil/detail/{id}', [UserController::class, 'edit'])->name('profil-detail.edit');
    
    Route::get('pengajuan-berkas', [PengajuanBerkasController::class, 'index'])->name('pengajuan-berkas.index');
    Route::post('/ubah-profil-pegawai', [App\Http\Controllers\ProfilController::class, 'ubahProfilPegawai'])->name('ubah-profil-pegawai');
    Route::post('pengajuan-berkas', [PengajuanBerkasController::class, 'store'])->name('pengajuan-berkas.store');
    Route::patch('pengajuan-berkas', [PengajuanBerkasController::class, 'update'])->name('pengajuan-berkas.update');

    Route::get('pegawai/periode', [PeriodePegawaiController::class, 'index'])->name('pegawai-periode.index');
    Route::get('pegawai/periode/{id}', [PeriodePegawaiController::class, 'detail'])->name('pegawai-periode.detail');

    Route::resource('/arsip', ArsipController::class);

    Route::get('/profil/detail', [App\Http\Controllers\ProfilController::class, 'detail'])->name('profil.detail');

    Route::get('/unduh-berkas/{file}', [App\Http\Controllers\PengajuanBerkasController::class, 'unduhBerkas'])->name('unduh-berkas');
});

Route::group(['middleware' => ['auth','auth_bkpsdm']], function(){
    Route::get('bkpsdm/periode', [PeriodeNaikPangkatController::class, 'daftarPeriode'])->name('bkpsdm-periode.index');
    Route::get('bkpsdm/periode/alternatif/{id}', [PeriodeAlternatifController::class, 'index'])->name('bkpsdm-periode-alternatif');
    Route::get('bkpsdm/periode/alternatif/peninjauan/{idPeriode}/{idAlternatif}', [PeriodeAlternatifController::class, 'detail'])->name('bkpsdm-periode-alternatif.detail');
    Route::post('bkpsdm/periode/alternatif/peninjauan', [PeriodeAlternatifController::class, 'store'])->name('bkpsdm-periode-alternatif.store');
    Route::post('bkpsdm/periode/alternatif/sk-kp', [PeriodeAlternatifController::class, 'kirimSkKp'])->name('bkpsdm-periode-alternatif-sk-kp.store');
});

Route::get('/send-email',function(){
    try {
        $body = "You are receiving this email because we received a password reset request for your account.";
    
        \Mail::send('email', ['body'=>$body], function($message){
            $message->from('bkpsdmminahasa73@gmail.com', 'BKPSDM Minahasa');
            $message->to('runtufandi@gmail.com')->subject('Testing');
        });
        dd("dikirim");
    } catch (\Throwable $th) {
        //throw $th;
        dd($th->getMessage());
    }
   
    dd("Email Berhasil dikirim.");
});
