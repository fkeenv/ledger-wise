<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class EmployeeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'first_name'    => 'required|string',
                'middle_name'   => 'nullable|string',
                'last_name'     => 'required|string',
                'gender'        => 'required|in:male,female',
                'mobile_number' => 'required|string',
                'birth_date'    => 'required|date',
            ],
            'PUT', 'PATCH' => [
                'first_name'    => 'required|string',
                'middle_name'   => 'nullable|string',
                'last_name'     => 'required|string',
                'gender'        => 'required|in:male,female',
                'mobile_number' => 'required|string',
                'birth_date'    => 'required|date',
            ]
        };
    }
}
