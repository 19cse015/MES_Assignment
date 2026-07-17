<?php

namespace App\Http\Requests\Product;

use App\Enums\BomStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBomRequest extends FormRequest
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
                'required',
                'exists:products,id',
            ],

            'version' => [
                'required',
                'integer',
                'min:1',
            ],



            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.material_id' => [
                'required',
                'exists:materials,id',
                'distinct',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'gt:0',
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'items.required' => 'At least one material is required.',

            'items.*.material_id.distinct' =>
                'Duplicate materials are not allowed.',

        ];
    }
}
