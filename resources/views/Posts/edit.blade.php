<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
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
            --primary: #3b82f6;
            --primary-hover: #2563eb;
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
            --primary: #2d5bff;
            --primary-hover: #1f45cc;
            --error: #d33;
        }
        body { font-family: system-ui, sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 2rem; transition: background 0.2s, color 0.2s; }
        .header { max-width: 420px; margin: 0 auto 1rem; display: flex; justify-content: space-between; align-items: center; }
        .theme-toggle { padding: .4rem .8rem; background: var(--card-bg); color: var(--text); border: 1px solid var(--border); border-radius: 4px; cursor: pointer; font-size: .9rem; }
        .card { max-width: 420px; margin: 0 auto; background: var(--card-bg); padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px var(--shadow); border: 1px solid var(--border); transition: background 0.2s, border-color 0.2s; }
        h1 { margin-top: 0; font-size: 1.4rem; color: var(--heading); }
        label { display: block; margin: 1rem 0 .3rem; font-weight: 600; color: var(--label); }
        input { width: 100%; padding: .55rem; border: 1px solid var(--input-border); border-radius: 4px; box-sizing: border-box; background: var(--input-bg); color: var(--text); }
        input.invalid { border-color: var(--error); }
        .error { color: var(--error); font-size: .85rem; margin-top: .25rem; }
        button[type="submit"] { margin-top: 1.25rem; width: 100%; padding: .65rem; background: var(--primary); color: #fff; border: 0; border-radius: 4px; font-size: 1rem; cursor: pointer; }
        button[type="submit"]:hover { background: var(--primary-hover); }
        a { color: var(--link); text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <div></div>
        <button class="theme-toggle" id="theme-toggle">🌙 Dark</button>
    </div>
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