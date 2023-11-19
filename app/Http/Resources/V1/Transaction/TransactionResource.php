<?php

namespace App\Http\Resources\V1\Transaction;

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
            "id" => $this->id,
            // "uuid" => $this->uuid,
            "customerId" => $this->customer_id,
            "debit" => $this->debit,
            "credit" => $this->credit,
            "description" => $this->description,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
