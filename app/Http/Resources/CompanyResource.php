<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Company
 */
final class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bs' => $this->getAttribute('bs'),
            'catchPhrase' => $this->getAttribute('catch_phrase'),
            'name' => $this->getAttribute('name'),
        ];
    }
}
