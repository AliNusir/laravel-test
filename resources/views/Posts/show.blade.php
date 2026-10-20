<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->name }}</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; padding: 2rem; }
        .card { max-width: 420px; margin: 0 auto; background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        .row { margin: 1rem 0; }
        .label { font-weight: 600; color: #555; font-size: .85rem; text-transform: uppercase; }
        a { color: #2d5bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Post #{{ $post->id }}</h1>

        <div class="row">
            <div class="label">Name</div>
            <div>{{ $post->name }}</div>
        </div>

        <div class="row">
            <div class="label">Number</div>
            <div>{{ $post->number }}</div>
        </div>

        <div class="row">
            <div class="label">Created</div>
            <div>{{ $post->created_at->format('Y-m-d H:i') }}</div>
        </div>

        <a href="{{ route('posts.create') }}">← Create another</a>
    </div>
</body>
</html>