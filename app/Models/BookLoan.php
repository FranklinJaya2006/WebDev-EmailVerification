<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Book;
use App\Models\Cd;
use App\Models\Newspaper;
use App\Models\DVD;
use App\Models\Jurnal;


class BookLoan extends Model
{
    use HasFactory;

    protected $fillable = ['id_pengguna', 'borrowed_at', 'returned_at'];

    protected $table = 'book_loans';

    public function librarian()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function item()
    {
        return $this->morphTo();
    }
}
