<form action="{{ route('updatebook', $book->id) }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" value="{{ $book->title }}" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="{{ $book->author }}" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" value="{{ $book->thn_terbit }}" required><br>

    <label>Jumlah Halaman:</label>
    <input type="number" name="jml_halaman" value="{{ $book->jml_halaman }}" required><br>

    <label>Description:</label>
    <textarea name="description">{{ $book->description }}</textarea><br>

    <button type="submit">Update Buku</button>
</form>
