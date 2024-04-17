<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseListRequest extends FormRequest
{
    use FailedValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['integer', 'min:1'],
            'limit' => ['integer', 'min:1'],
            'sort_direction' => ['required', 'string', Rule::in(['asc','desc'])]
        ];
    }

    public function messages(): array
    {
        return [
            'page.min' => __('validation.min', ['name' => __('model.attributes.page_number'), 'number' => 1]),
            'page.integer' => __('validation.integer', ['name' => __('model.attributes.page_number')]),
            'limit.min' => __('validation.min', ['name' => __('model.attributes.limit'), 'number' => 1]),
            'limit.integer' => __('validation.integer', ['name' => __('model.attributes.limit')]),
            'sort_direction.required' => __('validation.required', ['name' => __('model.attributes.sorting_direction')]),
            'sort_direction.in' => __('validation.in', ['name' => __('model.attributes.sorting_direction'), 'values' => 'asc, desc']),
        ];
    }
}
