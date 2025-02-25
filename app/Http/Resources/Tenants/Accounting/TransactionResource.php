<?php

namespace App\Http\Resources\Tenants\Accounting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'reference'   => $this->reference,
            'description' => $this->description,
            'date'        => $this->date,
            'splits'      => TransactionSplitResource::collection($this->splits),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
