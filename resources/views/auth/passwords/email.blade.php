<!-- resources/views/auth/passwords/email.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <div style="max-width: 400px; margin: auto; padding: 20px;">
        <h2>Reset Password</h2>

        @if(session('status'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div>
                <label for="email">Enter your email address:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>