<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;

class AttachmentService
{
    public function create(int $bookId, UploadedFile $file, string $path): Attachment
    {
        return Attachment::create([
            'book_id' => $bookId,
            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name' => basename($path),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
        ]);
    }
}