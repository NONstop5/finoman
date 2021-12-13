<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            {
                return [
                    'category_type_id' => 'nullable|integer|exists:category_types,id',
                ];
            }
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'category_type_id' => 'required|integer|exists:category_types,id',
                    'name' => 'required|string|max:100',
                    'icon' => 'string|max:50',
                    'budget' => 'required|numeric',
                ];
            }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [
            'category_type_id' => 'тип категории',
            'name' => 'название категории',
            'icon' => 'иконка категории',
            'budget' => 'бюджет категории',
        ];
    }
}
