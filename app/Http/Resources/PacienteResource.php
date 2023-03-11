<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identificador' => $this->id,
            'nombres' => Str::ucfirst($this->nombres),
            'apellidos' => Str::ucfirst($this->apellidos),
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'dni' => $this->dni,
            'tipo_sangre' => $this->tipo_sangre,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'fecha_creada' => $this->created_at->format('d-m-Y'),
            'fecha_actualizada' => $this->updated_at->format('d-m-Y')
        ];
    }
    public function with($request)
    {
        return [
            'res' => true,
        ];
    }
}
