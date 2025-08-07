<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Finca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FincaController extends Controller
{
// GET /api/v1/fincas
    public function index()
    {
        return response()->json(Finca::paginate(15));
    }

    // POST /api/v1/fincas
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'propietario' => 'required|string|max:255',
            'imagen' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $finca = Finca::create($validator->validated());
        return response()->json($finca, 201);
    }

    // GET /api/v1/fincas/{id}
    public function show(Finca $finca)
    {
        return response()->json($finca);
    }

    // PUT /api/v1/fincas/{id}
    public function update(Request $request, Finca $finca)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'ubicacion' => 'sometimes|required|string|max:255',
            'propietario' => 'sometimes|required|string|max:255',
            'imagen' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $finca->update($validator->validated());
        return response()->json($finca);
    }

    // DELETE /api/v1/fincas/{id}
    public function destroy(Finca $finca)
    {
        $finca->delete();
        return response()->json(null, 204);
    }
}
