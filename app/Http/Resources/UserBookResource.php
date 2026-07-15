<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;

class UserBookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'return_date' => $this->return_date,
            'borrow_date' => $this->created_at,
            
            'user' => new UserResource($this->whenLoaded('user')), //exposes name and id of user who borrowed book
            
            'book' => new BookResource($this->whenLoaded('book')), //exposes name and of book borrowed by user
        ];
    }
}