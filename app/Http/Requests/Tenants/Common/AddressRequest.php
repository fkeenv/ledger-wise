<?php

namespace App\Http\Requests\Tenants\Common;

use App\Http\Requests\BaseRequest;

class AddressRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match($this->method()) {
            'GET' => [],
            'POST', 'PUT', 'PATCH' => [
                'address1' => ['required', 'string'],
                'address2' => ['nullable', 'string'],
                'city' => ['required', 'string'],
                'state' => ['required', 'string'],
                'zip' => ['required', 'string'],
                'country' => ['required', 'string'],
                'type' => ['required', 'in:billing,shipping,both'],
            ],
            default => [],
        };
    }
}
