<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class DepartmentRequest extends BaseRequest
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
                'parent_id'   => ['nullable', 'integer'],
                'name'        => ['required', 'string', 'max:255', 'unique:departments,name'],
                'description' => ['nullable', 'string'],
            ],
            'PUT', 'PATCH' => [
                'parent_id'   => ['nullable', 'integer'],
                'name'        => ['required', 'string', 'max:255', "unique:departments,name,{$this->department->id}"],
                'description' => ['nullable', 'string'],
            ],
        };
    }
}
