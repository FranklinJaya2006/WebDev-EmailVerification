<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $primaryKey = 'id_pengguna';
     // protected $keyType = 'string';
    public $incrementing = true; // Jika idUser bukan auto-increment
     
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Books: Seorang librarian bisa memiliki banyak buku
    public function books()
    {
        return $this->hasMany(Book::class, 'id_pengguna');
    }

    // Relasi ke DVDs: Seorang librarian bisa memiliki banyak DVD
    public function dvds()
    {
        return $this->hasMany(Dvd::class, 'id_pengguna');
    }

    // Relasi ke CDs: Seorang librarian bisa memiliki banyak CD
    public function cds()
    {
        return $this->hasMany(Cd::class, 'id_pengguna');
    }

    // Relasi ke Journals: Seorang librarian bisa memiliki banyak Journal
    public function journals()
    {
        return $this->hasMany(Journal::class, 'id_pengguna');
    }

    // Relasi ke Newspapers: Seorang librarian bisa memiliki banyak Newspaper
    public function newspapers()
    {
        return $this->hasMany(Newspaper::class, 'id_pengguna');
    }
}
