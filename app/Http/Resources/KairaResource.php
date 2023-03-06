<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KairaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        // Map Domain User model values
        return [
            'data' => [
                'urlapi' => $this->urlapi()->value(),
                'urlcast' => $this->urlcast()->value(),
            ]
        ];
    }
}
