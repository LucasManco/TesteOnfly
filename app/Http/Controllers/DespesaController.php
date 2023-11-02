<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Despesa;
use App\Http\Requests\DespesasPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\novaDespesa;


class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $despesas = Despesa::where('usuario', $user->id)->orderBy('created_at','desc')->get();
        return view("despesas.index")->with('despesas',$despesas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('despesas.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(DespesasPostRequest $request)
     {
        $validated = $request->validated();
        $despesa = Despesa::create($validated);
        $this->getUserAuthenticated()->notify(new novaDespesa($despesa));
        return redirect('/despesas');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $despesa = Despesa::find($id);
        $this->authorize('verificaUsuario', $despesa);
        return view('despesas.edit')->with('despesa',$despesa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DespesasPostRequest $request, string $id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('verificaUsuario', $despesa);
        $despesa->update($request->all());
        return redirect('/despesas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('verificaUsuario', $despesa);
        $despesa->delete();
        return redirect('/despesas');
    }
}
