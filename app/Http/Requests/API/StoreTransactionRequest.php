<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'debit' => 'required_without:credit',
            'credit' => 'required_without:debit',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.exists' => 'Customer ID does not exist',
            'credit.required_without' => 'Credit amount is required when debit amount is not provided',
            'debit.required_without' => 'Debit amount is required when credit amount is not provided',
        ];
    }
}
