<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['User_Name', 'User_Email', 'password'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    use HasApiTokens;

    public $timestamps = true;
    
    protected $primaryKey = 'id';
    /** @use HasFactory<UserFactory> */
   // use HasFactory, Notifiable;
    public function borrowing(): HasMany{
        return $this->hasMany(UserBook::class, "user_id", "id");
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