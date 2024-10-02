<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class EmployeePositionRequest extends BaseRequest
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
                'position_ids'   => ['required', 'array'],
                'position_ids.*' => ['required', 'exists:positions,id'],
            ],
            'PUT', 'PATCH' => [
                'position_ids'   => ['required', 'array'],
                'position_ids.*' => ['required', "exists:positions,id,employee_id,{$this->employee->id}"],
            ]
        };
    }
}
