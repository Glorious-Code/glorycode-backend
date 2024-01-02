<?php

use App\Actions\Languages\ChangeUserLanguage;
use App\Actions\Roles\CreateRole;
use App\Actions\Roles\DeleteRole;
use App\Actions\Roles\EditRole;
use App\Actions\Roles\GetRoles;
use App\Actions\Roles\StoreRole;
use App\Actions\Roles\UpdateRole;
use App\Http\Controllers\FrontController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [FrontController::class, 'front'])->name('frontpage');
Route::post('language', ChangeUserLanguage::class)->name('language.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('admin')->middleware(['password.confirm'])->group(function () {
        Route::prefix('roles')->group(function () {
            Route::get('/', GetRoles::class)->name('roles.index');
            Route::get('/create', CreateRole::class)->name('roles.create');
            Route::post('/create', CreateRole::class)->name('roles.create.search');
            Route::get('/edit/{id}', EditRole::class)->name('roles.edit');
            Route::post('/edit/{id}', EditRole::class)->name('roles.edit.search');
            Route::delete('/{id}', DeleteRole::class)->name('roles.delete');
            Route::post('/', StoreRole::class)->name('roles.store');
            Route::patch('/{id}', UpdateRole::class)->name('roles.update');
        });
    });
});
