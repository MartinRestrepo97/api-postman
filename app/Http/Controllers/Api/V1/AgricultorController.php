<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Agricultor;
use App\Models\Finca;
use App\Models\Animal;
use App\Models\Vegetal;
use App\Models\Preparado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgricultorController extends Controller
{
    // GET /api/v1/agricultores
    public function index()
    {
        return response()->json(Agricultor::paginate(15));
    }

    // POST /api/v1/agricultores
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:100',
            'imagen' => 'required|string',
            'documento' => 'required|string|max:50|unique:agricultores,documento',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $agricultor = Agricultor::create($validator->validated());
        return response()->json($agricultor, 201);
    }

    // GET /api/v1/agricultores/{id}
    public function show(Agricultor $agricultor)
    {
        return response()->json($agricultor);
    }

    // PUT /api/v1/agricultores/{id}
    public function update(Request $request, Agricultor $agricultor)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'sometimes|required|string|max:255',
            'apellidos' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:100',
            'imagen' => 'sometimes|required|string',
            'documento' => 'sometimes|required|string|max:50|unique:agricultores,documento,' . $agricultor->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $agricultor->update($validator->validated());
        return response()->json($agricultor);
    }

    // DELETE /api/v1/agricultores/{id}
    public function destroy(Agricultor $agricultor)
    {
        $agricultor->delete();
        return response()->json(null, 204);
    }

    // Asocia una finca a un agricultor
    public function attachFinca(Agricultor $agricultor, Finca $finca)
    {
        $agricultor->fincas()->syncWithoutDetaching([$finca->id]);
        return response()->json(['message' => 'Finca asociada correctamente.'], 200);
    }

    // Desasocia una finca de un agricultor
    public function detachFinca(Agricultor $agricultor, Finca $finca)
    {
        $agricultor->fincas()->detach($finca->id);
        return response()->json(['message' => 'Finca desasociada correctamente.'], 200);
    }

    // Asocia un animal a un agricultor
    public function attachAnimal(Agricultor $agricultor, Animal $animal)
    {
        $agricultor->animales()->syncWithoutDetaching([$animal->id]);
        return response()->json(['message' => 'Animal asociado correctamente.'], 200);
    }

    // Desasocia un animal de un agricultor
    public function detachAnimal(Agricultor $agricultor, Animal $animal)
    {
        $agricultor->animales()->detach($animal->id);
        return response()->json(['message' => 'Animal desasociado correctamente.'], 200);
    }

    // Asocia un vegetal a un agricultor
    public function attachVegetal(Agricultor $agricultor, Vegetal $vegetal)
    {
        $agricultor->vegetales()->syncWithoutDetaching([$vegetal->id]);
        return response()->json(['message' => 'Vegetal asociado correctamente.'], 200);
    }

    // Desasocia un vegetal de un agricultor
    public function detachVegetal(Agricultor $agricultor, Vegetal $vegetal)
    {
        $agricultor->vegetales()->detach($vegetal->id);
        return response()->json(['message' => 'Vegetal desasociado correctamente.'], 200);
    }

    // Asocia un preparado a un agricultor
    public function attachPreparado(Agricultor $agricultor, Preparado $preparado)
    {
        $agricultor->preparados()->syncWithoutDetaching([$preparado->id]);
        return response()->json(['message' => 'Preparado asociado correctamente.'], 200);
    }

    // Desasocia un preparado de un agricultor
    public function detachPreparado(Agricultor $agricultor, Preparado $preparado)
    {
        $agricultor->preparados()->detach($preparado->id);
        return response()->json(['message' => 'Preparado desasociado correctamente.'], 200);
    }
}
