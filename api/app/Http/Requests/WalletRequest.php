<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
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
                    'wallet_type_id' => 'nullable|integer|exists:wallet_types,id',
                ];
            }
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'wallet_type_id' => 'required|integer|exists:wallet_types,id',
                    'currency_id' => 'required|integer|exists:currencies,id',
                    'name' => 'required|string|max:100',
                    'icon' => 'required|string|max:50',
                    'balance' => 'required|numeric',
                    'balance_date' => 'required|date',
                ];
            }
            default:
                break;
        }
    }
}
