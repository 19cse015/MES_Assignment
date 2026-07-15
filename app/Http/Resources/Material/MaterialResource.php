<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'category' => [

                'id' => $this->category?->id,

                'name' => $this->category?->name,

            ],

            'name' => $this->name,

            'unit' => $this->unit,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];;
    }
}
