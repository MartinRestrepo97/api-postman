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
        return response()->json($vegetal);
    }

    // PUT /api/v1/vegetales/{id}
    public function update(Request $request, Vegetal $vegetal)
    {
        $validator = Validator::make($request->all(), [
            'especie' => 'sometimes|required|string|max:255',
            'cultivo' => 'sometimes|required|string|max:255',
            'observaciones' => 'nullable|string',
            'imagen' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vegetal->update($validator->validated());
        return response()->json($vegetal);
    }

    // DELETE /api/v1/vegetales/{id}
    public function destroy(Vegetal $vegetal)
    {
        $vegetal->delete();
        return response()->json(null, 204);
    }
}
