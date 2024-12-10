<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create DVD</title>
</head>
<body>
<h1>Tambah DVD</h1>
<form action="{{ route('storedvd') }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Author:</label>
    <input type="text" name="author" required><br>

    <label>Artist:</label>
    <input type="text" name="artist" required><br>

    <label>Genre:</label>
    <input type="text" name="genre" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" required><br>

    <button type="submit">Tambah DVD</button>
</form>
</body>
</html>
