<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Newspaper</title>
</head>
<body>
<h1>Tambah Surat Kabar</h1>
<form action="{{ route('storenewspaper') }}" method="POST">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Publisher:</label>
    <input type="text" name="publisher" required><br>

    <label>Category:</label>
    <input type="text" name="category" required><br>

    <label>Tahun Terbit:</label>
    <input type="number" name="thn_terbit" required><br>

    <button type="submit">Tambah Surat Kabar</button>
</form>
</body>
</html>
