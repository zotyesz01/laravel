<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use \App\Http\Requests\BaseListRequest;
use Illuminate\Validation\Rule;

class ListProductRequest extends BaseListRequest
{
    public array $sortByFields = ['id','name', 'net_price', 'gross_price', 'description', 'created_at', 'updated_at'];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'sort_by' => ['required', 'string', Rule::in($this->sortByFields)],
        ];

        return array_merge(
            parent::rules(),
            $rules
        );
    }

    public function messages(): array
    {
        $messages = [
            'sort_by.required' => __('validation.required', ['name' => __('model.attributes.sorting')]),
            'sort_by.string' => __('validation.string', ['name' => __('model.attributes.sorting')]),
            'sort_by.in' => __('validation.in', ['name' => __('model.attributes.sort_by_attribute'), 'values' => implode(", ", $this->sortByFields)]),
        ];

        return array_merge(
            parent::messages(),
            $messages
        );
    }
}
