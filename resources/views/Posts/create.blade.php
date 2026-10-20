<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Post</title>
    <style>
        :root[data-theme="dark"] {
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text: #e5e7eb;
            --heading: #f1f5f9;
            --label: #cbd5e1;
            --input-bg: #0f172a;
            --input-border: #475569;
            --border: #334155;
            --shadow: rgba(0,0,0,.3);
            --link: #60a5fa;
            --link-hover: #93c5fd;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
            --success-bg: #14532d;
            --success-text: #bbf7d0;
            --success-border: #15803d;
            --error: #f87171;
        }
        :root[data-theme="light"] {
            --bg: #f4f5f7;
            --card-bg: #fff;
            --text: #1e293b;
            --heading: #0f172a;
            --label: #334155;
            --input-bg: #fff;
            --input-border: #cbd5e1;
            --border: #e2e8f0;
            --shadow: rgba(0,0,0,.1);
            --link: #2d5bff;
            --link-hover: #1f45cc;
            --primary: #2d5bff;
            --primary-hover: #1f45cc;
            --danger: #d33;
            --danger-hover: #a82222;
            --success-bg: #e6f6ea;
            --success-text: #1b6e32;
            --success-border: #86efac;
            --error: #d33;
        }
        body { font-family: system-ui, sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 2rem; transition: background 0.2s, color 0.2s; }
        .header { max-width: 420px; margin: 0 auto 1rem; display: flex; justify-content: space-between; align-items: center; }
        .theme-toggle { padding: .4rem .8rem; background: var(--card-bg); color: var(--text); border: 1px solid var(--border); border-radius: 4px; cursor: pointer; font-size: .9rem; }
        .theme-toggle:hover { opacity: 0.9; }
        .card { max-width: 420px; margin: 0 auto; background: var(--card-bg); padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px var(--shadow); border: 1px solid var(--border); transition: background 0.2s, border-color 0.2s; }
        h1 { margin-top: 0; font-size: 1.4rem; color: var(--heading); }
        label { display: block; margin: 1rem 0 .3rem; font-weight: 600; color: var(--label); }
        input { width: 100%; padding: .55rem; border: 1px solid var(--input-border); border-radius: 4px; box-sizing: border-box; background: var(--input-bg); color: var(--text); transition: background 0.2s, color 0.2s, border-color 0.2s; }
        input.invalid { border-color: var(--error); }
        .error { color: var(--error); font-size: .85rem; margin-top: .25rem; }
        .success { background: var(--success-bg); color: var(--success-text); padding: .6rem; border-radius: 4px; margin-bottom: 1rem; border: 1px solid var(--success-border); }
        button[type="submit"] { margin-top: 1.25rem; width: 100%; padding: .65rem; background: var(--primary); color: #fff; border: 0; border-radius: 4px; font-size: 1rem; cursor: pointer; }
        button[type="submit"]:hover { background: var(--primary-hover); }
        a { color: var(--link); text-decoration: none; }
        a:hover { color: var(--link-hover); text-decoration: underline; }
        .delete-btn { width: auto; margin-top: 0; padding: .3rem .7rem; font-size: .85rem; background: var(--danger); color: #fff; border: 0; }
        .delete-btn:hover { background: var(--danger-hover); }
        .edit-btn { padding: .3rem .7rem; font-size: .85rem; background: var(--primary); color: #fff; border-radius: 4px; }
        .edit-btn:hover { background: var(--primary-hover); text-decoration: none; }
    </style>
</head>
<body>
    <div class="header">
        <div></div>
        <button class="theme-toggle" id="theme-toggle">🌙 Dark</button>
    </div>
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
    <script>
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', savedTheme);
        toggle.textContent = savedTheme === 'dark' ? '☀️ Light' : '🌙 Dark';
        
        toggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            toggle.textContent = newTheme === 'dark' ? '☀️ Light' : '🌙 Dark';
        });
    </script>
</body>
</html>