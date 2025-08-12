<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Vegetal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VegetalController extends Controller
{
    // GET /api/v1/vegetales
    public function index()
    {
        return response()->json(Vegetal::paginate(15));
    }

    // POST /api/v1/vegetales
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'especie' => 'required|string|max:255',
            'cultivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'imagen' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vegetal = Vegetal::create($validator->validated());
        return response()->json($vegetal, 201);
    }

    // GET /api/v1/vegetales/{id}
    public function show(Vegetal $vegetal)
    {
        $model = \App\Models\Vegetal::find(request()->route('vegetal'));
        if (!$model) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($model);
    }

    // PUT /api/v1/vegetales/{id}
    public function update(Request $request, Vegetal $vegetal)
    {
        $model = $vegetal;
        if (!$model) {
            $model = \App\Models\Vegetal::withTrashed()->find($request->route('vegetal'));
        }
        if (!$model) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'especie' => 'sometimes|required|string|max:255',
            'cultivo' => 'sometimes|required|string|max:255',
            'observaciones' => 'nullable|string',
            'imagen' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $model->fill($validator->validated());
        $model->save();
        $updated = \App\Models\Vegetal::withTrashed()->find($model->id);
        if ($updated) {
            return response()->json($updated, 200);
        }
        return response()->json([], 200);
    }

    // DELETE /api/v1/vegetales/{id}
    public function destroy(Vegetal $vegetal)
    {
        $vegetal->agricultores()->detach();
        $vegetal->delete();
        return response()->json(null, 204);
    }
}
