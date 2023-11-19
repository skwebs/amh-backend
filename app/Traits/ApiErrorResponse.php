<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed',
    ], 422));
}
