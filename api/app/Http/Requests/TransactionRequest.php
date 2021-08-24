<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
            'wallet_from_id' => 'required|integer|exists:transactions,id',
            'wallet_to_id' => 'nullable|integer|exists:transactions,id',
            'transaction_type_id' => 'required|integer|exists:transaction_types,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'amount' => 'required|numeric',
            'transacted_at' => 'required|date',
        ];
    }
}
