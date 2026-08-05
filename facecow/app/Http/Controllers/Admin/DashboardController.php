<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cattle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el panel de administración con estadísticas resumidas.
     */
    public function index()
    {
        $totalCattle = Cattle::count();
        
        // Simular localizadores activos y revisiones según los datos reales
        $activeGPS = Cattle::whereNotNull('latitude')->count();
        $pendingChecks = Cattle::where('health_status', 'En Tratamiento')->orWhere('health_status', 'Crítico')->count();
        $verifiedCount = Cattle::where('origin', 'verificado')->count();
        
        $verifiedPercent = $totalCattle > 0 ? round(($verifiedCount / $totalCattle) * 100, 1) : 0;
        
        // Cargar últimos registros para el historial
        $recentCattle = Cattle::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCattle',
            'activeGPS',
            'pendingChecks',
            'verifiedPercent',
            'recentCattle'
        ));
    }
}
