<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name">
        @error('name')
            <p style="color: red; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror

        <br>
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
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="<PASSWORD>">
        @error('password_confirmation')
            <p style="color: red; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror

        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
