<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Customer</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            padding: 40px;
        }
        .box {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #00c853;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #009e41;
        }
        a {
            display: block;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Register Customer</h2>

    <form action="{{ url('/register') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Daftar</button>
</form>


    <a href="{{ route('customer.auth.login') }}">Sudah punya akun? Login</a>
</div>

</body>
</html>
