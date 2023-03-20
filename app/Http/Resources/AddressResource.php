<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Address
 */
final class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'city' => $this->getAttribute('city'),
            'geo' => [
                'lat' => (string) $this->getAttribute('latitude'),
                'lon' => (string) $this->getAttribute('longitude'),
            ],
            'street' => $this->getAttribute('street'),
            'suite' => $this->getAttribute('suite'),
            'zipcode' => $this->getAttribute('zipcode'),
        ];
    }
}
