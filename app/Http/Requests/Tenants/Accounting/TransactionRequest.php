<?php

namespace App\Http\Requests\Tenants\Accounting;

use App\Http\Requests\BaseRequest;

class TransactionRequest extends BaseRequest
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
                'description'         => ['required', 'string'],
                'date'                => ['required', 'date'],
                'splits'              => ['required', 'array', 'min:2'],
                'splits.*.account_id' => ['required', 'exists:accounts,id'],
                'splits.*.amount'     => ['required', 'numeric'],
                'splits.*.type'       => ['required', 'in:debit,credit'],
            ],
            'PATCH' => [
                'description'         => ['required', 'string'],
                'date'                => ['required', 'date'],
            ]
        };
    }

    public function messages()
    {
        return [
            'splits.min'                 => 'At least two transaction lines are required.',
            'splits.*.account_id.exists' => 'The selected account is invalid.',
            'splits.*.amount.numeric'    => 'The amount must be a number.',
            'splits.*.type.in'           => 'The type must be either debit or credit.',
        ];
    }
}
