<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class SearchRequest extends RequestAbstract
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => ['required', 'string', 'min:3'],
        ];
    }
}
