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
            'vin' => ['required', 'string', 'unique:cars'],
            'registration_plate' => ['required', 'string', 'unique:cars'],
            'model_id' => ['required', 'integer', 'exists:car_models,id'],
            'color' => ['required', 'string'],
            'year' => ['required', 'integer', 'digits:4'],
        ];
    }
}
