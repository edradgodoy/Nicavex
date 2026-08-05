<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cattle;
use Illuminate\Http\Request;

class CattleController extends Controller
{
    /**
     * Muestra la lista de ganado.
     */
    public function index()
    {
        $cattles = Cattle::all();
        return view('admin.cattle.index', compact('cattles'));
    }

    /**
     * Almacena un nuevo registro de ganado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'arete' => 'required|string|unique:cattles,arete',
            'breed' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'health_status' => 'required|string',
            'origin' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Coordenadas por defecto en Nicaragua si no se especifican
        $validated['latitude'] = $validated['latitude'] ?? (12.1150 + (rand(-1000, 1000) / 10000));
        $validated['longitude'] = $validated['longitude'] ?? (-86.2362 + (rand(-1000, 1000) / 10000));

        Cattle::create($validated);

        return redirect()->route('admin.cattle.index')
            ->with('success', __('Cattle Saved Successfully'));
    }

    /**
     * Actualiza un registro existente de ganado.
     */
    public function update(Request $request, Cattle $cattle)
    {
        $validated = $request->validate([
            'arete' => 'required|string|unique:cattles,arete,' . $cattle->id,
            'breed' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'health_status' => 'required|string',
            'origin' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $cattle->update($validated);

        return redirect()->route('admin.cattle.index')
            ->with('success', __('Cattle Saved Successfully'));
    }

    /**
     * Elimina un registro de ganado.
     */
    public function destroy(Cattle $cattle)
    {
        $cattle->delete();

        return redirect()->route('admin.cattle.index')
            ->with('success', __('Cattle Deleted Successfully'));
    }

    /**
     * Muestra la vista del mapa con los pines GPS de todo el ganado.
     */
    public function map()
    {
        $cattles = Cattle::all(['arete', 'breed', 'health_status', 'origin', 'latitude', 'longitude']);
        return view('admin.map', compact('cattles'));
    }
}
