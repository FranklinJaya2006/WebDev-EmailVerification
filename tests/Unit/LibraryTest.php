<?php

namespace Tests\Unit;

use Tests\TestCase; // Pastikan menggunakan TestCase dari Laravel
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LibraryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_user()
    {
        // Arrange
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => bcrypt('password'), // Pastikan password dienkripsi
            'role' => 'admin',
        ];

        // Act
        $user = User::create($data);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertTrue(password_verify('password', $user->password));
        $this->assertEquals('admin', $user->role);
    }
}
