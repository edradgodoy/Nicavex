<?php

use App\Http\Controllers\Admin\CattleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Web)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para el cambio de idioma
Route::get('locale/{lang}', function (string $lang) {
    if (in_array($lang, ['es', 'en'])) {
        session(['locale' => $lang]);
        cookie()->queue('locale', $lang, 60 * 24 * 365); // 1 año
    }
    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Rutas Privadas / Administrativas (Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    
    // Panel de control (Dashboard)
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventario de ganado (Cattle CRUD)
    Route::get('cattle', [CattleController::class, 'index'])->name('admin.cattle.index');
    Route::post('cattle', [CattleController::class, 'store'])->name('admin.cattle.store');
    Route::put('cattle/{cattle}', [CattleController::class, 'update'])->name('admin.cattle.update');
    Route::delete('cattle/{cattle}', [CattleController::class, 'destroy'])->name('admin.cattle.destroy');

    // Mapa satelital de geolocalización
    Route::get('map', [CattleController::class, 'map'])->name('admin.map');
});

/*
|--------------------------------------------------------------------------
| Sobrescribir Ruta de Redirección Breeze por defecto
|--------------------------------------------------------------------------
*/
Route::redirect('dashboard', 'admin/dashboard');

Route::post('logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
