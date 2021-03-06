<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Registro;

use Illuminate\Http\Request;

class RelatorioPessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Registro::RankingPessoas();
        return response()->json(['data'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registros  $registros
     * @return \Illuminate\Http\Response
     */
    public function show(Registros $registros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registros  $registros
     * @return \Illuminate\Http\Response
     */
    public function edit(Registros $registros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registros  $registros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registros $registros)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registros  $registros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registros $registros)
    {
        //
    }
}
