<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    use FailedValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'description' => 'nullable|string',
        ];

        $rules['name'] = 'required|string|max:255|unique:category,name';
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
        ];
    }
}
