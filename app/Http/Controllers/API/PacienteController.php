<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarPacienteRequest;
use App\Http\Requests\GuardarPacienteRequest;
use App\Models\Paciente;
use App\Http\Resources\PacienteResource;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Paciente::all();
        return PacienteResource::collection(Paciente::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarPacienteRequest $request)
    {
        // Paciente::create($request->all());
        // return response()->json([
        //     'res' => true,
        //     'msg' => 'Paciente Guardado Correctamente'
        // ],200);
        return (new PacienteResource(Paciente::create($request->all())))->additional(['msg' => 'Paciente Guardado Correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        // return response()->json([
        //     'res' => true,
        //     'paciente' => $paciente
        // ],200);
        return new PacienteResource($paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarPacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        // return response()->json([
        //     'res' => true,
        //     "msg" => 'Paciente Actualizado Correctamente'
        // ],200);
        return (new PacienteResource($paciente))->additional(['msg' => 'Paciente Actualizado Correctamente'])->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        // return response()->json([
        //     'res' => true,
        //     "msg" => 'Paciente Eliminado Correctamente'
        // ],200);
        return (new PacienteResource($paciente))->additional(['msg' => 'Paciente Eliminado Correctamente']);
    }
}
