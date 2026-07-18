<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array // basically formatting data to send to frontend
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'publisher_name' => $this->publisher_name,
            'publish_date' => $this->publish_date // lowercase changes output and vice versa
        ];
    }
}