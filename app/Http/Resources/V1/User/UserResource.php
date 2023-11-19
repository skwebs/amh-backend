<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'emailVerifiedAt' => $this->email_verified_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];

        // return parent::toArray($request);
    }
}
