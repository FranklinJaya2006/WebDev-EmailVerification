<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BookLoan;
use App\Models\User;

class Newspaper extends Model
{
    use HasFactory;
    
     /**
     * fillable
     *
     * @var array
     */

    protected $table = 'newspapers';
    protected $fillable = [
        'author',
        'title',
        'publisher',
        'category',
        'thn_terbit',
        'status',
        'id_pengguna'
    ];

    public function bookLoans()
    {
        return $this->morphMany(BookLoan::class, 'item');
    }
    
    public function librarian()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
