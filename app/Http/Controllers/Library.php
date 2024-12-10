<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Cd;
use App\Models\Jurnal;
use App\Models\Newspaper;
use App\Models\Dvd;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class Library extends Controller
{
    public function filter(Request $request)
    {
        $kategori = $request->input('kategori');
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting

        $items = [];
        $fields = [];
        $message = "Pilih kategori untuk memfilter data";

        // Filter data berdasarkan kategori dan sesuaikan atributnya
        switch ($kategori) {
            case 'book':
                $items = Book::orderBy('title', $sortOrder)->get();
                $fields = ['title', 'description', 'author', 'thn_terbit', 'jml_halaman'];
                $message = "Menampilkan Buku";
                break;
            case 'jurnal':
                $items = Jurnal::orderBy('title', $sortOrder)->get();
                $fields = ['title', 'description', 'author', 'thn_terbit', 'jml_halaman'];
                $message = "Menampilkan Jurnal";
                break;
            case 'cd':
                $items = Cd::orderBy('title', $sortOrder)->get();
                $fields = ['author', 'title', 'artist', 'genre', 'thn_terbit'];
                $message = "Menampilkan CD";
                break;
            case 'newspaper':
                $items = Newspaper::orderBy('title', $sortOrder)->get();
                $fields = ['title', 'publisher', 'category', 'thn_terbit'];
                $message = "Menampilkan Surat Kabar";
                break;
            case 'dvd':
                $items = Dvd::orderBy('title', $sortOrder)->get();
                $fields = ['author', 'title', 'artist', 'genre', 'thn_terbit'];
                $message = "Menampilkan Dvd";
                break;
        }

        return view('librarian', compact('items', 'message', 'kategori', 'sortOrder', 'fields'));
    }

    public function createItem(Request $request)
    {
        $kategori = $request->input('kategori');

        switch ($kategori) {
            case 'book':
                return redirect()->route('createbook');
            case 'jurnal':
                return redirect()->route('createjurnal');
            case 'cd':
                return redirect()->route('createcd');
            case 'newspaper':
                return redirect()->route('createnewspaper');
            case 'dvd':
                return redirect()->route('createdvd');
            default:
                return redirect()->back()->with('error', 'Pilih kategori yang valid!');
        }
    }

    public function storeBook(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'jml_halaman' => 'required|integer',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah role pengguna adalah admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Error: Admin role is not allowed to add a book.'
            ], 403); // 403 Forbidden error jika admin
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::create([
            'id_pengguna' => $user->id_pengguna,
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'jml_halaman' => $request->jml_halaman,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'author' => $book->author,
                'thn_terbit' => $book->thn_terbit,
                'jml_halaman' => $book->jml_halaman,
            ]
        ], 201);

        return redirect()->route('librarian')->with('success', 'Buku berhasil ditambahkan!');
    }


    public function storeJurnal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'jml_halaman' => 'required|integer',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah role pengguna adalah admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Error: Admin role is not allowed to add a book.'
            ], 403); // 403 Forbidden error jika admin
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $jurnal = Jurnal::create([
            'id_pengguna' => $user->id_pengguna,
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'jml_halaman' => $request->jml_halaman,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $jurnal->id,
                'title' => $jurnal->title,
                'description' => $jurnal->description,
                'author' => $jurnal->author,
                'thn_terbit' => $jurnal->thn_terbit,
                'jml_halaman' => $jurnal->jml_halaman,
            ]
        ], 201);

        return redirect()->route('librarian')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function storeCd(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah role pengguna adalah admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Error: Admin role is not allowed to add a book.'
            ], 403); // 403 Forbidden error jika admin
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cd = Cd::create([
            'id_pengguna' => $user->id_pengguna,
            'title' => $request->title,
            'artist' => $request->artist,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'genre' => $request->genre,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $cd->id,
                'title' => $cd->title,
                'artist' => $cd->artist,
                'author' => $cd->author,
                'thn_terbit' => $cd->thn_terbit,
                'genre' => $cd->genre,
            ]
        ], 201);

        return redirect()->route('librarian')->with('success', 'CD berhasil ditambahkan!');
    }

    public function storeNewspaper(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah role pengguna adalah admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Error: Admin role is not allowed to add a book.'
            ], 403); // 403 Forbidden error jika admin
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $np = Newspaper::create([
            'id_pengguna' => $user->id_pengguna,
            'title' => $request->title,
            'publisher' => $request->publisher,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'category' => $request->category,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $np->id,
                'title' => $np->title,
                'publisher' => $np->publisher,
                'author' => $np->author,
                'thn_terbit' => $np->thn_terbit,
                'category' => $np->category
            ]
        ], 201);

        return redirect()->route('librarian')->with('success', 'Surat Kabar berhasil ditambahkan!');
    }

    public function storeDvd(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah role pengguna adalah admin
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Error: Admin role is not allowed to add a book.'
            ], 403); // 403 Forbidden error jika admin
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $dvd = Dvd::create([
            'id_pengguna' => $user->id_pengguna,
            'title' => $request->title,
            'artist' => $request->artist,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'genre' => $request->genre,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $dvd->id,
                'title' => $dvd->title,
                'artist' => $dvd->artist,
                'author' => $dvd->author,
                'thn_terbit' => $dvd->thn_terbit,
                'genre' => $dvd->genre,
            ]
        ], 201);
        
        return redirect()->route('librarian')->with('success', 'DVD berhasil ditambahkan!');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('editbook', compact('book'));
    }

    // Method untuk melakukan update book
    public function updateBook(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'jml_halaman' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Newspaper not found'
            ], 404);
        }

        $book->update([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'author' => $request->author,
            'thn_terbit' => $request->thn_terbit,
            'cathegory' => $request->cathegory,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'author' => $book->author,
                'thn_terbit' => $book->thn_terbit,
                'jml_halaman' => $book->jml_halaman,
            ]
        ], 200);

        // Redirect kembali ke halaman librarian dengan pesan sukses
        return redirect()->route('librarian')->with('success', 'Buku berhasil diperbarui!');
    }

    // Method untuk menampilkan form edit jurnal
    public function editJurnal($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        return view('editjurnal', compact('jurnal'));
    }

    // Method untuk melakukan update jurnal
    public function updateJurnal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'jml_halaman' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'status' => false,
                'message' => 'Newspaper not found'
            ], 404);
        }

        $jurnal->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'thn_terbit' => $request->input('thn_terbit'),
            'jml_halaman' => $request->input('jml_halaman'),
        ]);        

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => [
                'id' => $jurnal->id,
                'title' => $jurnal->title,
                'description' => $jurnal->description,
                'author' => $jurnal->author,
                'thn_terbit' => $jurnal->thn_terbit,
                'jml_halaman' => $jurnal->jml_halaman,
            ]
        ], 200);

        return redirect()->route('librarian')->with('success', 'Jurnal berhasil diperbarui!');
    }

    // Method untuk menampilkan form edit cd
    public function editCd($id)
    {
        $cd = Cd::findOrFail($id);
        return view('editcd', compact('cd'));
    }

    // Method untuk melakukan update cd
    public function updateCd(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cd = Cd::find($id);

        if (!$cd) {
            return response()->json([
                'status' => false,
                'message' => 'Newspaper not found'
            ], 404);
        }

        $cd->update([
            'title' => $request->input('title'),
            'artist' => $request->input('artist'),
            'author' => $request->input('author'),
            'thn_terbit' => $request->input('thn_terbit'),
            'genre' => $request->input('genre'),
        ]);        

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => [
                'id' => $cd->id,
                'title' => $cd->title,
                'artist' => $cd->artist,
                'author' => $cd->author,
                'thn_terbit' => $cd->thn_terbit,
                'genre' => $cd->genre,
            ]
        ], 200);

        return redirect()->route('librarian')->with('success', 'CD berhasil diperbarui!');
    }

    // Method untuk menampilkan form edit newspaper
    public function editNewspaper($id)
    {
        $newspaper = Newspaper::findOrFail($id);
        return view('editnewspaper', compact('newspaper'));
    }

    // Method untuk melakukan update newspaper
    public function updateNewspaper(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'publisher' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $np = Newspaper::find($id);

        if (!$np) {
            return response()->json([
                'status' => false,
                'message' => 'Newspaper not found'
            ], 404);
        }

        $np->update([
            'title' => $request->input('title'),
            'publisher' => $request->input('publisher'),
            'author' => $request->input('author'),
            'thn_terbit' => $request->input('thn_terbit'),
            'category' => $request->input('category'),
        ]);        

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => [
                'id' => $np->id,
                'title' => $np->title,
                'publisher' => $np->publisher,
                'author' => $np->author,
                'thn_terbit' => $np->thn_terbit,
                'category' => $np->category,
            ]
        ], 200);

        return redirect()->route('librarian')->with('success', 'Surat Kabar berhasil diperbarui!');
    }

    // Method untuk menampilkan form edit dvd
    public function editDvd($id)
    {
        $dvd = Dvd::findOrFail($id);
        return view('editdvd', compact('dvd'));
    }

    // Method untuk melakukan update dvd
    public function updateDvd(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|string',
            'author' => 'required|string|max:255',
            'thn_terbit' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $dvd = Dvd::find($id);

        if (!$dvd) {
            return response()->json([
                'status' => false,
                'message' => 'Newspaper not found'
            ], 404);
        }

        $dvd->update([
            'title' => $request->input('title'),
            'artist' => $request->input('artist'),
            'author' => $request->input('author'),
            'thn_terbit' => $request->input('thn_terbit'),
            'genre' => $request->input('genre'),
        ]);        

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => [
                'id' => $dvd->id,
                'title' => $dvd->title,
                'artist' => $dvd->artist,
                'author' => $dvd->author,
                'thn_terbit' => $dvd->thn_terbit,
                'genre' => $dvd->genre,
            ]
        ], 200);

        return redirect()->route('librarian')->with('success', 'DVD berhasil diperbarui!');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        if ($book) {
            $book->delete();
            return redirect()->route('librarian')->with('success', 'Buku berhasil dihapus.');
        }
        return redirect()->route('librarian')->with('error', 'Buku tidak ditemukan.');
    }

    public function deleteJurnal($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        if ($jurnal) {
            $jurnal->delete();
            return redirect()->route('librarian')->with('success', 'Jurnal berhasil dihapus.');
        }
        return redirect()->route('librarian')->with('error', 'Jurnal tidak ditemukan.');
    }

    public function deleteCd($id)
    {
        $cd = Cd::findOrFail($id);
        if ($cd) {
            $cd->delete();
            return redirect()->route('librarian')->with('success', 'CD berhasil dihapus.');
        }
        return redirect()->route('librarian')->with('error', 'CD tidak ditemukan.');
    }

    public function deleteNewspaper($id)
    {
        $newspaper = Newspaper::findOrFail($id);
        if ($newspaper) {
            $newspaper->delete();
            return redirect()->route('librarian')->with('success', 'Surat Kabar berhasil dihapus.');
        }
        return redirect()->route('librarian')->with('error', 'Surat Kabar tidak ditemukan.');
    }

    public function deleteDvd($id)
    {
        $dvd = Dvd::findOrFail($id);
        if ($dvd) {
            $dvd->delete();
            return redirect()->route('librarian')->with('success', 'DVD berhasil dihapus.');
        }
        return redirect()->route('librarian')->with('error', 'DVD tidak ditemukan.');
    }

    public function approveItem($id)
    {
        // Temukan item yang masih pending
        $item = Item::find($id);
        
        if ($item && $item->status === 'pending') {
            $item->status = 'approved'; // Update status menjadi approved
            $item->save();
            
            return redirect()->route('librarian')->with('success', 'Item berhasil disetujui.');
        }

        return redirect()->route('librarian')->with('error', 'Item tidak ditemukan atau sudah disetujui.');
    }

    public function rejectItem($id)
    {
        // Temukan item yang masih pending
        $item = Item::find($id);
        
        if ($item && $item->status === 'pending') {
            $item->status = 'rejected'; // Update status menjadi rejected
            $item->save();
            
            return redirect()->route('librarian')->with('error', 'Item telah ditolak.');
        }

        return redirect()->route('librarian')->with('error', 'Item tidak ditemukan atau sudah disetujui.');
    }

}
