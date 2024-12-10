<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Newspaper;
use App\Models\User; // Tambahkan model User
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewspaperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_jurnal()
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
            'publisher' => 'crerbvrbe',
            'thn_terbit' => '2003',
            'category' => 'harem',
            'status' => 'published',
            'id_pengguna' => $user->id_pengguna, // Ambil id_pengguna dari user yang dibuat
        ];

        // Act: Buat buku
        $book = Newspaper::create($data);

        // Assert: Pastikan buku berhasil dibuat
        $this->assertInstanceOf(Newspaper::class, $book);
        $this->assertDatabaseHas('newspapers', $data); // Memastikan data ada di database
    }
}
