<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; padding: 2rem; }
        .card { max-width: 420px; margin: 0 auto; background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        label { display: block; margin: 1rem 0 .3rem; font-weight: 600; }
        input { width: 100%; padding: .55rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input.invalid { border-color: #d33; }
        .error { color: #d33; font-size: .85rem; margin-top: .25rem; }
        button { margin-top: 1.25rem; width: 100%; padding: .65rem; background: #2d5bff; color: #fff; border: 0; border-radius: 4px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #1f45cc; }
        a { color: #2d5bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Edit Post #{{ $post->id }}</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $post->name) }}"
                   class="@error('name') invalid @enderror" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="number">Number</label>
            <input type="number" id="number" name="number" value="{{ old('number', $post->number) }}"
                   class="@error('number') invalid @enderror" required>
            @error('number')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Save Changes</button>
        </form>

        <p><a href="{{ route('posts.create') }}">← Back</a></p>
    </div>
</body>