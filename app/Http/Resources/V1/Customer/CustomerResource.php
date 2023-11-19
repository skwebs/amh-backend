<?php

namespace App\Http\Resources\V1\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "name" => $this->name,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "emailVerifiedAt" => $this->email_verified_at,
            "address" => $this->address,
            "lastPurchase" => $this->last_purchase,
            "lastPayment" => $this->last_payment,
            "balance" => $this->balance,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
