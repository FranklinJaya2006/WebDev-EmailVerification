<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Primary key tabel books
            $table->unsignedBigInteger('id_pengguna'); // Kolom foreign key
            $table->string('author');
            $table->string('title');
            $table->text('description');
            $table->integer('thn_terbit')->default(0);
            $table->integer('jml_halaman')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        
            // Definisi foreign key
            $table->foreign('id_pengguna')
                  ->references('id_pengguna') // Referensi kolom di tabel users
                  ->on('users')
                  ->onDelete('cascade'); // Aksi ketika user dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
