<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Pearl\RequestValidate\RequestAbstract;

class CarRequest extends RequestAbstract
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'vin' => ['required', 'string', Rule::unique('cars', 'vin')->ignore($id)],
            'registration_plate' => [
                'required',
                'string',
                Rule::unique('cars', 'registration_plate')->ignore($id)
            ],
            'color' => ['sometimes', 'nullable', 'string'],
            'year' => ['sometimes', 'nullable', 'integer', 'digits:4'],
        ];
    }
}
