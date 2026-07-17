<?php

namespace App\Http\Requests\Production;

use App\Enums\ProductionOrderStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateProductionOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [

            'product_id' => [
                'sometimes',
                'exists:products,id',
            ],

            'bom_id' => [
                'sometimes',
                'exists:boms,id',
            ],

            'quantity' => [
                'sometimes',
                'integer',
                'min:1',
            ],

            'status' => [
                'sometimes',
                new Enum(ProductionOrderStatusEnum::class),
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'planned_at' => [
                'nullable',
                'date',
            ],
         ];
    }
}
