<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    // GET /api/v1/animales
    public function index()
    {
        return response()->json(Animal::paginate(15));
    }

    // POST /api/v1/animales
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'especie' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'alimentacion' => 'required|string',
            'cuidados' => 'required|string',
            'reproduccion' => 'required|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $animal = Animal::create($validator->validated());
        return response()->json($animal, 201);
    }

    // GET /api/v1/animales/{id}
    public function show(Animal $animal)
    {
        $model = \App\Models\Animal::find(request()->route('animal'));
        if (!$model) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($model);
    }

    // PUT /api/v1/animales/{id}
    public function update(Request $request, Animal $animal)
    {
        $model = $animal;
        if (!$model) {
            $model = \App\Models\Animal::withTrashed()->find($request->route('animal'));
        }
        if (!$model) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'especie' => 'sometimes|required|string|max:255',
            'raza' => 'sometimes|required|string|max:255',
            'alimentacion' => 'sometimes|required|string',
            'cuidados' => 'sometimes|required|string',
            'reproduccion' => 'sometimes|required|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $model->fill($validator->validated());
        $model->save();
        $updated = \App\Models\Animal::withTrashed()->find($model->id);
        if ($updated) {
            return response()->json($updated, 200);
        }
        return response()->json([], 200);
    }

    // DELETE /api/v1/animales/{id}
    public function destroy(Animal $animal)
    {
        $animal->agricultores()->detach();
        $animal->delete();
        return response()->json(null, 204);
    }
}
