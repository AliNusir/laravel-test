<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Post</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; padding: 2rem; }
        .card { max-width: 420px; margin: 0 auto; background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        label { display: block; margin: 1rem 0 .3rem; font-weight: 600; }
        input { width: 100%; padding: .55rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input.invalid { border-color: #d33; }
        .error { color: #d33; font-size: .85rem; margin-top: .25rem; }
        .success { background: #e6f6ea; color: #1b6e32; padding: .6rem; border-radius: 4px; margin-bottom: 1rem; }
        button { margin-top: 1.25rem; width: 100%; padding: .65rem; background: #2d5bff; color: #fff; border: 0; border-radius: 4px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #1f45cc; }
        a { color: #2d5bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .delete-btn { width: auto; margin-top: 0; padding: .3rem .7rem; font-size: .85rem; background: #d33; }
        .delete-btn:hover { background: #a82222; }
        .edit-btn { padding: .3rem .7rem; font-size: .85rem; background: #2d5bff; color: #fff; border-radius: 4px; }
        .edit-btn:hover { background: #1f45cc; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Create a Post</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="@error('name') invalid @enderror" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="number">Number</label>
            <input type="number" id="number" name="number" value="{{ old('number') }}"
                   class="@error('number') invalid @enderror" required>
            @error('number')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Create Post</button>
        </form>
        {{ $ex }}
    <div style=" padding: .5rem;">
    @forelse ($poop as $post)
        <div style="display: flex; justify-content: space-between; align-items: center; margin: .3rem 0;">
    <a href="{{ route('posts.show', $post) }}">
        {{ $post->name }} ({{ $post->number }})
    </a>

    <div style="display: flex; gap: .4rem;">
        <a href="{{ route('posts.edit', $post) }}" class="edit-btn">Edit</a>

        <form method="POST" action="{{ route('posts.destroy', $post) }}"
              onsubmit="return confirm('Delete this post?')" style="margin: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Delete</button>
        </form>
    </div>
</div>
        
    @empty
        <div>No posts found.</div>
    @endforelse
</div>
    </div>
</body>
</html>