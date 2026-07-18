<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttachmentResource extends JsonResource
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
            'book_id' => $this->book_id,
            'original_file_name' => $this->original_file_name,
            'stored_file_name' => $this->stored_file_name,
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'url' => Storage::url($this->file_path),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}