<?php
namespace App\Http\Controllers\API;

use App\Models\BookLoan;
use App\Models\Book;
use App\Models\Cd;
use App\Models\Newspaper;
use App\Models\DVD;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookLoanController extends Controller
{
    // Mengajukan peminjaman buku oleh librarian
    public function createLoan(Request $request)
    {
        // Validasi input
        $request->validate([
            'item_id' => 'required|exists:items,id', // Validasi ID item
            'borrowed_at' => 'required|date',
        ]);

        // Membuat permintaan peminjaman baru
        $loan = new BookLoan([
            'librarian_id' => auth()->user()->id, // ID librarian yang mengajukan
            'item_id' => $request->item_id, // ID item yang dipinjam
            'borrowed_at' => $request->borrowed_at, // Tanggal peminjaman
            'status' => 'pending', // Status awal adalah pending
        ]);

        // Simpan peminjaman
        $loan->save();

        // Mengirimkan response sukses
        return response()->json([
            'message' => 'Peminjaman berhasil diajukan dan menunggu approval.',
            'loan' => $loan
        ], 201); // 201 Created status
    }

    // Approval atau penolakan pengajuan pinjaman oleh admin
    public function approveLoan($id)
    {
        // Cari peminjaman berdasarkan ID
        $loan = BookLoan::findOrFail($id);

        // Update status peminjaman menjadi 'approved'
        $loan->status = 'approved';
        $loan->save();

        // Mengirimkan response sukses
        return response()->json([
            'message' => 'Peminjaman telah disetujui.',
            'loan' => $loan
        ]);
    }

    // Menolak pengajuan pinjaman oleh admin
    public function rejectLoan($id)
    {
        // Cari peminjaman berdasarkan ID
        $loan = BookLoan::findOrFail($id);

        // Update status peminjaman menjadi 'rejected'
        $loan->status = 'rejected';
        $loan->save();

        // Mengirimkan response error
        return response()->json([
            'message' => 'Peminjaman ditolak.',
            'loan' => $loan
        ], 400); // 400 Bad Request status
    }

    // Hapus item (admin)
    public function deleteItem($id)
    {
        // Cari item berdasarkan ID dan hapus
        $item = Item::findOrFail($id);
        $item->delete();

        // Mengirimkan response sukses
        return response()->json([
            'message' => 'Item berhasil dihapus.'
        ]);
    }
}
