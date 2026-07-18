<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Fillable(['name', 'publisher_name', 'publish_date', 'added_by'])]
class Book extends Model
{   
    protected $primaryKey = 'id';

    use SoftDeletes;

    public function borrowing(): HasMany
    {
        return $this->hasMany(UserBook::class, "book_id", "id");
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,"added_by","id");
    }

        public function attachments(): HasMany
    {
    return $this->hasMany(Attachment::class);
    }
}