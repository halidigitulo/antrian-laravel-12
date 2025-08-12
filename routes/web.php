<?php

use App\Http\Controllers\AmbilAntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigAntrianController;
use App\Http\Controllers\ConfigLoketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisplayAntrianController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\LoketAntrianController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpesialisasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Can;
use Spatie\Permission\Contracts\Role;

Route::middleware(['guest'])->group(function () {
    Route::get('', [AuthController::class, 'login'])->name('login');
    Route::post('', [AuthController::class, 'auth_login'])->name('auth_login');
    Route::post('generate-queue/{jenisAntrianId}', [AmbilAntrianController::class, 'generateQueue']);
    Route::get('latest-queues', [DisplayAntrianController::class, 'getLatestQueues'])->name('loket.latest-queues');
    Route::get('/ambil-antrian', [AmbilAntrianController::class, 'index'])->name('ambilantrian.index');
    Route::get('/display-antrian', [DisplayAntrianController::class, 'index'])->name('displayantrian.index');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'menus/'], function () {
        Route::get('', [MenuController::class, 'index'])->name('menus.index');
        Route::post('', [MenuController::class, 'store'])->name('menus.store');
        Route::get('{menu}', [MenuController::class, 'show'])->name('menus.show');
        Route::put('{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::get('order', [MenuController::class, 'order'])->name('menus.order');
        Route::post('reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
    });

    Route::group(['prefix' => 'roles/'], function () {
        Route::get('', [RoleController::class, 'index'])->name('roles.index');
        Route::post('', [RoleController::class, 'store'])->name('roles.store');
        Route::get('{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::put('{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::group(['prefix' => 'permission/'], function () {
        Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('generator', [PermissionController::class, 'generate'])->name('permissions.generate');
        Route::put('{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    Route::group(['prefix' => 'users/'], function () {
        Route::get('', [UserController::class, 'index'])->name('users.index');
        Route::post('', [UserController::class, 'storeOrUpdate'])->name('users.store');
        Route::put('{id}', [UserController::class, 'storeOrUpdate'])->name('users.update');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
        Route::post('profile/update', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    });

    Route::group(['prefix' => 'profile/'], function () {
        Route::get('', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::group(['prefix' => 'dokter/'], function () {
        Route::get('', [DokterController::class, 'index'])->name('dokter.index');
        Route::post('', [DokterController::class, 'storeOrUpdate'])->name('dokter.store');
        Route::put('{id}', [DokterController::class, 'storeOrUpdate'])->name('dokter.update');
        Route::get('{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
        Route::delete('destroy/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
        Route::post('{id}/updateStatus', [DokterController::class, 'updateStatus'])->name('dokter.updateStatus');
    });

    Route::group(['prefix' => 'konfigurasi/'], function () {
        Route::get('', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');
        Route::post('', [KonfigurasiController::class, 'update'])->name('generalsettings.update');

        Route::group(['prefix' => 'loket/'], function () {
            Route::get('index', [ConfigLoketController::class, 'index'])->name('loket.index');
            Route::post('', [ConfigLoketController::class, 'storeOrUpdate'])->name('loket.store');
            Route::put('{id}', [ConfigLoketController::class, 'storeOrUpdate'])->name('loket.update');
            Route::get('{id}/edit', [ConfigLoketController::class, 'edit'])->name('loket.edit');
            Route::delete('destroy/{id}', [ConfigLoketController::class, 'destroy'])->name('loket.destroy');
            Route::post('reset-all', [ConfigLoketController::class, 'resetAllLoket'])->name('loket.resetAll');
        });

        Route::group(['prefix' => 'antrian/'], function () {
            Route::get('index', [ConfigAntrianController::class, 'index'])->name('antrian.index');
            Route::post('', [ConfigAntrianController::class, 'storeOrUpdate'])->name('antrian.store');
            Route::put('{id}', [ConfigAntrianController::class, 'storeOrUpdate'])->name('antrian.update');
            Route::get('{id}/edit', [ConfigAntrianController::class, 'edit'])->name('antrian.edit');
            Route::delete('destroy/{id}', [ConfigAntrianController::class, 'destroy'])->name('antrian.destroy');
        });

        Route::group(['prefix' => 'spesialisasi/'], function () {
            Route::get('', [SpesialisasiController::class, 'index'])->name('spesialisasi.index');
            Route::post('spesialisasi', [SpesialisasiController::class, 'store'])->name('spesialisasi.store');
            Route::put('{id}', [SpesialisasiController::class, 'update'])->name('spesialisasi.update');
            Route::delete('{spesialisasi}', [SpesialisasiController::class, 'destroy'])->name('spesialisasi.destroy');
        });
    });

    Route::group(['prefix' => 'antrian/'], function () {
        // Route untuk ambil antrian
        Route::group(['prefix' => 'ambil/'], function () {
            Route::get('', [AmbilAntrianController::class, 'index'])->name('ambilantrian.index');
        });

        // Route untuk loket antrian
        Route::group(['prefix' => 'loket/'], function () {
            Route::get('', [LoketAntrianController::class, 'index'])->name('loketantrian.index');
            Route::get('{loket_id}', [LoketAntrianController::class, 'show'])->name('loketantrian.detail');
            Route::post('assign-user', [LoketAntrianController::class, 'assignUser'])->name('loketantrian.assignUser');
            Route::post('set-user-aktif-null', [LoketAntrianController::class, 'setUserAktifNull'])->name('loket.setUserAktifNull');
            Route::post('panggil-antrian', [LoketAntrianController::class, 'panggilAntrian'])->name('loketantrian.panggil');
            Route::post('{id}/reset', [LoketAntrianController::class, 'reset']);
        });

        // Route untuk display antrian
        Route::group(['prefix' => 'display/'], function () {
            Route::get('', [DisplayAntrianController::class, 'index'])->name('displayantrian.index');
            Route::get('latest-called-queue', [DisplayAntrianController::class, 'getLatestCalledQueue'])->name('loket.latest-called-queue');
            Route::get('get-called-queue', [LoketAntrianController::class, 'getCalledQueue'])->name('loket.get-called-queue');
        });
        Route::get('{type}', [LoketAntrianController::class, 'getAntrianByType'])->name('loketantrian.by-type');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
