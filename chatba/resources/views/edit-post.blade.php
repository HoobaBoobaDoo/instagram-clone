<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->body }}</p>
    </div>
    <form action="/update-post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $post->title }}" style="display: block; margin-bottom: 10px;">
        <textarea name="body" style="display: block; margin-bottom: 10px;">{{ $post->body }}</textarea>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>