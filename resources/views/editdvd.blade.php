<form action="{{ route('updatedvd', $dvd->id) }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" value="{{ $dvd->title }}" required><br>

    <label>Author:</label>
    <input type="text" name="author" value="{{ $dvd->author }}" required><br>

    <label>Artist:</label>
    <input type="text" name="artist" value="{{ $dvd->artist }}" required><br>

    <label>Genre:</label>
    <input type="text" name="genre" value="{{ $dvd->genre }}" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" value="{{ $dvd->thn_terbit }}" required><br>

    <button type="submit">Update DVD</button>
</form>
