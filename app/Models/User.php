<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password'])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    public $timestamps = true;
    
    protected $primaryKey = 'id';
    /** @use HasFactory<UserFactory> */
   // use HasFactory, Notifiable;
    public function borrowing(): HasMany{
        return $this->hasMany(UserBook::class, "user_id", "id");
    }

    public function addedBooks(): HasMany
    {
        return $this->hasMany(Book::class,"added_by", "id");
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}