<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterVehiclesRequest;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Requests\UpdateVehiclesRequest;
use App\Models\Vehicles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterVehiclesRequest $request)
    {
        $brand = $request->validated('brand'); // ou $request->brand
        $vehicle = $request->validated('vehicle'); // ou $request->brand
        $year = $request->validated('year'); // ou $request->brand

        $vehicles = Vehicles::query();
        if ($brand) {
            $vehicles->where('brand', $brand);
        }
        if ($vehicle) {
            $vehicles->where('vehicle', 'like', '%' . $vehicle . '%');
        }
        if ($year) {
            $vehicles->where('year', $year);
        }

        $totalByBrands = Vehicles::select('brand', \DB::raw('count(*) as total'))
            ->groupBy('brand')
            ->get();
        $totalByYear = Vehicles::select('year', \DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();

        $data = [
            'vehicles' => $vehicles->orderByDesc('updated_at')->get(),
            'totalByBrands' => $totalByBrands,
            'totalByYear' => $totalByYear,
        ];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehiclesRequest $request)
    {
        $validated = $request->validated();
        Vehicles::create($validated);
        return response()->json(['message' => 'veiculo criado com sucesso']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicles::findOrFail($id);
        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehiclesRequest $request, string $id)
    {

        $vehicle = Vehicles::findOrFail($id);

        $validated = $request->validated();

        $vehicle->update($validated);

        return response()->json(['message' => 'veiculo atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicles::findOrFail($id);
        $vehicle::destroy($id);
        return response()->noContent();
    }
}
