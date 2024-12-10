<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Daftar Librarians</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Periksa apakah $librarians sudah didefinisikan dan tidak kosong -->
    @if (isset($librarians) && count($librarians) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($librarians as $librarian)
                    <tr>
                        <td>{{ $librarian->id }}</td>
                        <td>{{ $librarian->name }}</td>
                        <td>{{ $librarian->email }}</td>
                        <td>
                            <!-- Hapus librarian -->
                            <form action="{{ route('deleteLibrarian', $librarian->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus librarian ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada librarian yang terdaftar.</p>
    @endif

    <h1>Peminjaman yang Menunggu Approval</h1>

    <!-- Periksa apakah $pendingLoans sudah didefinisikan dan tidak kosong -->
    @if (isset($pendingLoans) && count($pendingLoans) > 0)
        @foreach ($pendingLoans as $loan)
            <p>
                Librarian ID: {{ $loan->librarian_id }}<br>
                Item ID: {{ $loan->item_id }}<br>
                Tanggal Pinjam: {{ $loan->borrowed_at }}<br>
                Status: {{ $loan->status }}<br>
                <form action="{{ route('approveLoan', $loan->id) }}" method="POST">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
                <form action="{{ route('rejectLoan', $loan->id) }}" method="POST">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </p>
        @endforeach
    @else
        <p>Tidak ada peminjaman yang menunggu approval.</p>
    @endif
</body>
</html>
