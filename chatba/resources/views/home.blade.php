<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div style="border: 3px solid black; padding: 20px; margin: 20px;">
        <h1>Welcome to the Home Page</h1>
        <p>This is a simple home page for our application.</p>
    </div>
    @auth
    <p>Welcome back, {{ auth()->user()->name }}!</p>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @else
        <h2>Register:</h2>
        <form action="/register" method="POST">
            @csrf
        <input name="name" type="text" placeholder="Username" style="display: block; margin-bottom: 10px;">
        <input name="email" type="email" placeholder="Email" style="display: block; margin-bottom: 10px;">
        <input name="password" type="password" placeholder="Password" style="display: block; margin-bottom: 10px;">
        <button>Register</button>
        </form>
        <h2>Login:</h2>
        <form action="/login" method="POST">
            @csrf
        <input name="loginname" type="text" placeholder="Username" style="display: block; margin-bottom: 10px;">
        <input name="loginpassword" type="password" placeholder="Password" style="display: block; margin-bottom: 10px;">
        <button>Login</button>
        </form>
    @endauth

    
</body>
</html>