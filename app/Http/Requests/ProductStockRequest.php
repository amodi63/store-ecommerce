<?php

namespace App\Http\Requests;

use App\Rules\ProductStock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'exists:products,id'],
            'sku' => ['nullable', 'min:3', 'max:12'],
            'manage_stock' => ['nullable'],
            // 'qty' => ['required_if:manage_stock,==,1'],
            'in_stock' => ['boolean'],
            'qty' => [new ProductStock($this->manage_stock)],
        ];
    }
}
