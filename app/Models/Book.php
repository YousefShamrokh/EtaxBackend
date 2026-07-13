<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Fillable(['Book_Name', 'Publisher_Name', 'Publish_Date'])]
class Book extends Model
{   
    protected $primaryKey = 'id';

    use SoftDeletes;

    public function borrowing(): HasMany{
        return $this->hasMany(UserBook::class, "book_id", "id");
    }
}