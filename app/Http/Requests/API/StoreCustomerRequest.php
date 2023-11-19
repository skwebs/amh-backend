<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCustomerRequest extends FormRequest
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
            // "customer_id" => "required|unique:customers,customer_id",
            "name" => "required|string|min:3",
            "email" => "nullable|email|unique:users,email",
            "mobile" => "nullable|numeric|unique:customers,mobile|digits:10|regex:/^[6-9]\d{9}$/",
            "address" => "nullable|string|min:5",
            "last_purchase" => "nullable|date|before_or_equal:today",
            "last_payment" => "nullable|date|before_or_equal:today",

            // "password" => [
            //     "nullable",
            //     "string",
            //     'confirmed',
            //     Password::min(8)
            //         ->numbers()
            //         ->letters()
            //         ->mixedCase()
            //         ->symbols(),
            // ],

        ];
    }

    public function messages(): array
    {
        return [
            "mobile.regex" => "Invalid Mobile Number",
        ];
    }
}
