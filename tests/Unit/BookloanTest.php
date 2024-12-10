<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\BookLoan;
use App\Models\User; // Tambahkan model User
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookloanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_bookloan()
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
            'id_pengguna' => $user->id_pengguna, // Ambil id_pengguna dari user yang dibuat
        ];

        // Act: Buat buku
        $book = BookLoan::create($data);

        // Assert: Pastikan buku berhasil dibuat
        $this->assertInstanceOf(BookLoan::class, $book);
        $this->assertDatabaseHas('book_loans', $data); // Memastikan data ada di database
    }
}
