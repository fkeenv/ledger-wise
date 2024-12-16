<?php

namespace App\Http\Requests\Tenants\Accounting;

use App\Http\Requests\BaseRequest;

class CustomerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'GET' => [],
            'POST', 'PUT', 'PATCH' => [
                'first_name'  => ['required'],
                'middle_name' => ['required'],
                'last_name'   => ['required'],
                'email'       => ['required', 'email'],
                'mobile'      => ['required'],
                'notes'       => ['nullable'],
                'is_active'   => ['required', 'boolean'],
                'is_taxable'  => ['required', 'boolean'],
            ],
            'DELETE' => [],
        };
    }
}
