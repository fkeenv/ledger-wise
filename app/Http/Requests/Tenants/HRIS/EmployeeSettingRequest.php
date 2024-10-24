<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class EmployeeSettingRequest extends BaseRequest
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
                'salary'          => ['required', 'numeric'],
                'salary_type'     => ['required', 'in:monthly,daily,hourly'],
                'tax'             => ['required', 'numeric'],
                'employment_type' => ['required', 'in:regular,part-time,internship,contract'],
                'start_date'      => ['required', 'date'],
                'regular_date'    => ['nullable', 'date'],
                'resign_date'     => ['nullable', 'date'],
                'can_overtime'    => ['required', 'boolean'],
                'is_active'       => ['required', 'boolean'],
                'data'            => ['nullable', 'array'],
            ],
            'PUT', 'PATCH' => [
                'salary'          => ['required', 'numeric'],
                'salary_type'     => ['required', 'in:monthly,daily,hourly'],
                'tax'             => ['required', 'numeric'],
                'employment_type' => ['required', 'in:regular,part-time,internship,contract'],
                'start_date'      => ['required', 'date'],
                'regular_date'    => ['nullable', 'date'],
                'resign_date'     => ['nullable', 'date'],
                'can_overtime'    => ['required', 'boolean'],
                'is_active'       => ['required', 'boolean'],
                'data'            => ['nullable', 'array'],
            ]
        };
    }
}
