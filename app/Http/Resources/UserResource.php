<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 */
final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->getAttribute('name'),
            'username' => $this->getAttribute('username'),
            'email' => $this->getAttribute('email'),
            'phone' => $this->getAttribute('phone'),
            'website' => $this->getAttribute('website'),
            'address' => $this->whenLoaded('address', new AddressResource($this->getAttribute('address'))),
            'company' => $this->whenLoaded('company', new CompanyResource($this->getAttribute('company'))),
        ];
    }
}
