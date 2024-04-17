<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    use FailedValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'net_price' => 'required|numeric|min:0',
            'gross_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id'
        ];

        $rules['name'] = 'required|string|max:255|unique:product,name';
        if(!is_null($this->id)){
            $rules['name'] .= ',' . $this->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['name' => __('model.attributes.name')]),
            'name.string' => __('validation.string', ['name' => __('model.attributes.name')]),
            'name.max' => __('validation.max', ['name' => __('model.attributes.name'), 'number' => '255']),
            'name.unique' => __('validation.unique', ['name' => __('model.attributes.name')]),
            'net_price.required' => __('validation.required', ['name' => __('model.attributes.net_price')]),
            'net_price.min' => __('validation.min', ['name' => __('model.attributes.net_price'), 'number' => 0]),
            'gross_price.required' => __('validation.required', ['name' => __('model.attributes.gross_price')]),
            'gross_price.min' => __('validation.min', ['name' => __('model.attributes.gross_price'), 'number' => 0]),
            'category_id.required' => __('validation.required', ['name' => __('model.category')]),
            'category_id.exists' => __('validation.exits', ['name' => __('model.category')]),
        ];
    }
}
