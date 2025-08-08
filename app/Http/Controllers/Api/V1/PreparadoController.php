<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Preparado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreparadoController extends Controller
{
    // GET /api/v1/preparados
    public function index()
    {
        return response()->json(Preparado::paginate(15));
    }

    // POST /api/v1/preparados
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'preparacion' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'imagen' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $preparado = Preparado::create($validator->validated());
        return response()->json($preparado, 201);
    }

    // GET /api/v1/preparados/{id}
    public function show(Preparado $preparado)
    {
        return response()->json($preparado);
    }

    // PUT /api/v1/preparados/{id}
    public function update(Request $request, Preparado $preparado)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'preparacion' => 'sometimes|required|string|max:255',
            'observaciones' => 'nullable|string',
            'imagen' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $preparado->update($validator->validated());
        $preparado->refresh();
        return response()->json($preparado, 200);
    }

    // DELETE /api/v1/preparados/{id}
    public function destroy(Preparado $preparado)
    {
        $preparado->agricultores()->detach();
        $preparado->delete();
        return response()->json(null, 204);
    }
}
