<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class CarRequest extends RequestAbstract
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'registration_plate' => ['required', 'string', 'unique:cars'],
            'make_id' => ['required', 'integer', 'exists:makes,id'],
            'model' => ['required', 'string'],
            'color' => ['required', 'string'],
            'year' => ['required', 'integer', 'digits:4'],
        ];
    }
}
