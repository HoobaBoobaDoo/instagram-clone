<!-- filepath: c:\Users\ruben\Documents\GitHub\instagram-clone\chatba\resources\views\home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #fafafa;
        }
        .navbar-brand {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-weight: bold;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .insta-card {
            background: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }
        .insta-card img {
            border-radius: 8px 8px 0 0;
            max-height: 100%;
            object-fit: cover;
            width: 100%;
        }
        .insta-card .card-body {
            padding: 1rem 1.5rem;
        }
        .insta-form input, .insta-form textarea {
            background: #fafafa;
            border: 1px solid #dbdbdb;
        }
        .insta-form input:focus, .insta-form textarea:focus {
            border-color: #a8a8a8;
            box-shadow: none;
        }
        .sidebar {
            min-width: 250px;
        }
        .main-content {
            max-width: 50vw;
            margin: 0 auto;
        }
        .profile-pic {
        height: 32px;
        width: auto;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .btn-link {
            color: #262626;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Chatba</a>
            <div class="ms-auto">
                @auth
                    <span class="me-3">Welcome, <strong>{{ auth()->user()->name }}</strong></span>
                    <form action="/logout" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container main-content">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                <div class="text-center mb-4">
                    <div class="d-flex justify-content-center">
                    <img src="\logo\chatba-logo-icon-dark.png" alt="Chatba Logo" class="mb-3 mx-2 img-fluid" style="max-width: 30px;">
                    <h1 class="fw-bold" style="font-family: 'Segoe UI', Arial, sans-serif;">Chatba</h1>
                    </div>
                    <p class="text-muted">Share your moments with the world.</p>
                </div>

                @auth
                <div class="insta-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Create Post</h5>
                        <form action="/create-post" method="POST" enctype="multipart/form-data" class="insta-form">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Post Title" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="body" class="form-control" placeholder="What's on your mind?" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="file" accept="image/*" name="image_path" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Share</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="insta-card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Register</h5>
                                <form action="/register" method="POST" class="insta-form">
                                    @csrf
                                    <div class="mb-3">
                                        <input name="name" type="text" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button class="btn btn-success w-100">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="insta-card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Login</h5>
                                <form action="/login" method="POST" class="insta-form">
                                    @csrf
                                    <div class="mb-3">
                                        <input name="loginname" type="text" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <input name="loginpassword" type="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button class="btn btn-primary w-100">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="/show-all-posts" class="btn btn-outline-secondary me-2">All posts</a>
                        @auth
                        <a href="/show-your-posts" class="btn btn-outline-primary">Show My Posts</a>
                        @endauth
                    </div>
                </div>

                @if ($posts->isEmpty())
                    <div class="alert alert-secondary text-center">No posts available.</div>
                @else
                    @foreach ($posts as $post)
                        <div class="insta-card">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <div class="post-header mb-2">
                                    <div>
                                        <span class="fw-bold">{{ $post->user->name }}</span>
                                        <span class="text-muted small ms-2">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->body }}</p>
                                @if (auth()->id() === $post->user_id)
                                    <div>
                                        <a href="/edit-post/{{ $post->id }}" class="btn-link me-2">Edit</a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>

    <script src=