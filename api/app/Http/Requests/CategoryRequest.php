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
        switch($this->method()) {
            case 'POST': {
                return [
                    'name' => 'required|string|max:100',
                    'budget' => 'required|numeric',
                    'category_type_id' => 'required|numeric',
                    'icon' => 'string|max:50'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return  [
                    'name' => 'required|string|max:100',
                    'budget' => 'required|numeric',
                    'category_type_id' => 'required|numeric',
                    'icon' => 'string|max:50'
                ];
            }
            default:
                break;
        }
    }
}
