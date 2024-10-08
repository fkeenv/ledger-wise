<?php

namespace App\Http\Requests\Tenants\HRIS;

use App\Http\Requests\BaseRequest;

class AttendanceRequest extends BaseRequest
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
                'time' => ['required', 'datetime'],
                'type' => ['required', 'in:start,pause,continue,stop'],
            ],
            'PUT', 'PATCH' => [
                'time' => ['required', 'datetime'],
                'type' => ['required', 'in:start,pause,continue,stop'],
            ],
        };
    }
}
