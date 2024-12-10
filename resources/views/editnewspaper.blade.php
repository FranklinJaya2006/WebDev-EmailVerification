<form action="{{ route('updatenewspaper', $newspaper->id) }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" value="{{ $newspaper->title }}" required><br>

    <label>Publisher:</label>
    <input type="text" name="publisher" value="{{ $newspaper->publisher }}" required><br>

    <label>Category:</label>
    <input type="text" name="category" value="{{ $newspaper->category }}" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" value="{{ $newspaper->thn_terbit }}" required><br>

    <button type="submit">Update Newspaper</button>
</form>
