<form action="{{ route('updatecd', $cd->id) }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" value="{{ $cd->title }}" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="{{ $cd->author }}" required><br>

    <label>Artist:</label>
    <input type="text" name="artist" value="{{ $cd->artist }}" required><br>

    <label>Genre:</label>
    <input type="text" name="genre" value="{{ $cd->genre }}" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" value="{{ $cd->thn_terbit }}" required><br>

    <button type="submit">Update CD</button>
</form>
