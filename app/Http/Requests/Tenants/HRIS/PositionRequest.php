<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class PositionRequest extends BaseRequest
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
                'parent_id'     => ['nullable', 'integer'],
                'department_id' => ['required', 'integer', 'exists:departments,id'],
                'name'          => ['required', 'string', 'max:255', 'unique:positions,name'],
                'description'   => ['nullable', 'string'],
            ],
            'PUT', 'PATCH' => [
                'parent_id'     => ['nullable', 'integer'],
                'department_id' => ['required', 'integer', 'exists:departments,id'],
                'name'          => ['required', 'string', 'max:255', "unique:positions,name,{$this->position->id}"],
                'description'   => ['nullable', 'string'],
            ],
        };
    }
}
