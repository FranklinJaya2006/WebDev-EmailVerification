<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan daftar librarian untuk View atau API
    // Menampilkan librarian berdasarkan ID
    public function showLibrarianById(Request $request, $id)
    {
    // Ambil data pengguna yang sedang login
    $user = User::find($id);

    // Pastikan hanya admin yang dapat melihat librarian
    if ($user->role !== 'admin') {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Only admin can view librarians'
        ], 403);
    }
    
    $lib = 'librarian';
    $users = User::where('role', $lib)->get();

    if ($users->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No users found with role ' . $role
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $users
    ], 200);
}

    



// Menghapus librarian berdasarkan ID
public function deleteLibrarian(Request $request, $id)
{
    // Ambil data pengguna yang sedang login
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Pastikan hanya admin yang dapat menghapus librarian
    if ($user->role === 'admin') {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Only admin can delete librarians'
        ], 403);
    }

    // Hapus librarian
    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'Librarian successfully deleted'
    ], 200);
}




    public function approveRequest($id)
    {
        $request = BookLoan::findOrFail($id);
        $request->update(['approved_at' => now()]);

        return redirect()->back()->with('success', 'Request berhasil disetujui.');
    }
}