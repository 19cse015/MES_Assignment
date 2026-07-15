<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BomResource extends JsonResource
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

            'product' => [

                'id' => $this->product->id,

                'name' => $this->product->name,

            ],

            'version' => $this->version,

            'status' => $this->status,

            'approved_by' => $this->approver
                ? [

                    'id' => $this->approver->id,

                    'name' => $this->approver->name,

                ]
                : null,

            'approved_at' => $this->approved_at,

            'items' => BomItemResource::collection(
                $this->whenLoaded('items')
            ),

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}
