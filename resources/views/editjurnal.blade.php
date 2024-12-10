<form action="{{ route('updatejurnal', $jurnal->id) }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" value="{{ $jurnal->title }}" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="{{ $jurnal->author }}" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" value="{{ $jurnal->thn_terbit }}" required><br>

    <label>Jumlah Halaman:</label>
    <input type="number" name="jml_halaman" value="{{ $jurnal->jml_halaman }}" required><br>

    <label>Description:</label>
    <textarea name="description">{{ $jurnal->description }}</textarea><br>

    <button type="submit">Update Jurnal</button>
</form>
