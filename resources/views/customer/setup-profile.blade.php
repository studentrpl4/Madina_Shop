<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            padding: 30px;
        }
        .container {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        input, select {
            width: 100%;
            margin-top: 8px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056d2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Setup Profile</h2>

    <form action="{{ route('customer.setupProfile') }}" method="POST">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="phone">Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>

        <label for="gender">Jenis Kelamin</label>
        <select name="gender" required>
            <option value="">-- Pilih --</option>
            <option value="laki-laki" {{ old('gender')=='laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="perempuan" {{ old('gender')=='perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label for="birth_date">Tanggal Lahir</label>
        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required>

        <button type="submit">Simpan & Lanjutkan</button>
    </form>
</div>

</body>
</html>
