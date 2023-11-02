<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Despesa;
use App\Http\Requests\DespesasPostRequest;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return response()->json(Despesa::where('usuario', $user->id)->orderBy('created_at','desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DespesasPostRequest $request)
    {
        $validated = $request->validated();
        $despesa = Despesa::create($validated);
        return response()->json($despesa);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $despesa = Despesa::findOrFail($id);
        return response()->json($despesa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DespesasPostRequest $request, string $id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('verificaUsuario', $despesa);
        $despesa->update($request->all());
        return response()->json($despesa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('verificaUsuario', $despesa);
        $despesa->delete();
        return response()->json(Despesa::all());
    }
}
