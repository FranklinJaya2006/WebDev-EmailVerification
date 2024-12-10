<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User; // Tambahkan model User
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        // Arrange: Buat pengguna secara manual
        $user = User::create([
            'id_pengguna' => 1, // Pastikan id_pengguna sesuai dengan foreign key
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
            'role' => 'librarian'
        ]);

        // Data untuk buku
        $data = [
            'author' => 'John',
            'title' => 'konken',
            'description' => 'crerbvrbe',
            'thn_terbit' => '2003',
            'jml_halaman' => '500',
            'status' => 'published',
            'id_pengguna' => $user->id_pengguna, // Ambil id_pengguna dari user yang dibuat
        ];

        // Act: Buat buku
        $book = Book::create($data);

        // Assert: Pastikan buku berhasil dibuat
        $this->assertInstanceOf(Book::class, $book);
        $this->assertDatabaseHas('books', $data); // Memastikan data ada di database
    }
}
