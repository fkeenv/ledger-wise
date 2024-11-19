<?php

namespace App\Http\Requests\Tenants\Accounting;

use App\Http\Requests\BaseRequest;

class AccountRequest extends BaseRequest
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
            'POST' => [
                'code'        => ['required', 'unique:accounts,code'],
                'name'        => ['required'],
                'description' => ['nullable'],
                'is_hidden'   => ['required', 'boolean'],
            ],
            'PUT', 'PATCH' => [
                'code'        => ['required', "unique:accounts,code,{$this->account->id},id"],
                'name'        => ['required'],
                'description' => ['nullable'],
                'is_hidden'   => ['required', 'boolean'],
            ],
            'DELETE' => [],
        };
    }
}
