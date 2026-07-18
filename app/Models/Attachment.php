<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['book_id','original_file_name','stored_file_name','file_path','mime_type',])] 
class Attachment extends Model
{
    public function book(): BelongsTo
    {
    return $this->belongsTo(Book::class);
    }
}
