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

    <div style="border: 3px solid black; padding: 20px; margin: 20px;">
        <h2>Create post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post Title" style="display: block; margin-bottom: 10px;">
            <textarea name="body" placeholder="Post Body" style="display: block; margin-bottom: 10px;"></textarea>
            <button type="submit">Create Post</button>
        </form>
    </div>

        
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

    <div style="border: 3px solid black; padding: 20px; margin: 20px;">
            <button onclick="window.location.href='/show-all-posts'">All posts</button>
            @auth
             <button onclick="window.location.href='/show-your-posts'">Show My Posts</button>   
            @endauth

            @if ($posts->isEmpty())
                <p>No posts available.</p>
            @else
            @foreach ($posts as $post)
                <div style="border: 1px solid gray; padding: 10px; margin-bottom: 10px;">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->body }}</p>
                    <p><strong>Author:</strong> {{ $post->user->name }}</p>
                    <p><strong>Created at:</strong> {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
                    @if (auth()->id() === $post->user_id)
                    <p><a href="/edit-post/{{ $post->id }}">Edit</a> | <form action="/delete-post/{{ $post->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                    @endif
                </div>
            @endforeach
            @endif
        </div>
</body>
</html>