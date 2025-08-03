<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @elseif(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email">
        @error('email')
            <p style="color: red; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror

        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password">
        @error('password')
            <p style="color: red; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror

        <br>
        <button type="submit">Login</button>
    </form>

</body>
</html>
