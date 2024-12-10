<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Book</title>
</head>
<body>
<h1>Tambah Buku</h1>
<form action="{{ route('storebook') }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Description:</label>
    <textarea name="description" required></textarea><br>

    <label>Author:</label>
    <input type="text" name="author" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" required><br>

    <label>Jumlah Halaman:</label>
    <input type="number" name="jml_halaman" required><br>

    <button type="submit">Tambah Buku</button>
</form>
</body>
</html>
