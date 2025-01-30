<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { text-align: center; border: 1px solid #ccc; padding: 100px; border-radius: 10px; }
        input { display: block; margin: 10px auto; padding: 10px; width: 100%; max-width: 300px; }
        button { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
