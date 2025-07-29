<!-- filepath: c:\Users\ruben\Documents\GitHub\instagram-clone\chatba\resources\views\edit-post.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Instagram Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #fafafa;
        }
        .main-content {
            max-width: 600px;
            margin: 40px auto;
        }
        .insta-card {
            background: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
        }
        .profile-pic {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Instagram</a>
        </div>
    </nav>
    <div class="container main-content">
        <div class="insta-card p-4">
            <h2 class="fw-bold mb-3" style="font-family: 'Segoe UI', Arial, sans-serif;">Edit Post</h2>
            <div class="mb-4 border rounded p-3 bg-light">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="mb-3 w-100 rounded">
                <h5 class="mb-1">{{ $post->title }}</h5>
                <p class="mb-0 text-muted">{{ $post->body }}</p>
            </div>
            <form action="/update-post/{{ $post->id }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Post Title" required>
                </div>
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="4" placeholder="Post Body" required>{{ $post->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Post</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>