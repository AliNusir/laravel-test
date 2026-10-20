<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->name }}</title>
    <style>
        :root[data-theme="dark"] {
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text: #e5e7eb;
            --heading: #f1f5f9;
            --label: #94a3b8;
            --border: #334155;
            --shadow: rgba(0,0,0,.3);
            --link: #60a5fa;
        }
        :root[data-theme="light"] {
            --bg: #f4f5f7;
            --card-bg: #fff;
            --text: #1e293b;
            --heading: #0f172a;
            --label: #555;
            --border: #e2e8f0;
            --shadow: rgba(0,0,0,.1);
            --link: #2d5bff;
        }
        body { font-family: system-ui, sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 2rem; transition: background 0.2s, color 0.2s; }
        .header { max-width: 420px; margin: 0 auto 1rem; display: flex; justify-content: space-between; align-items: center; }
        .theme-toggle { padding: .4rem .8rem; background: var(--card-bg); color: var(--text); border: 1px solid var(--border); border-radius: 4px; cursor: pointer; font-size: .9rem; }
        .card { max-width: 420px; margin: 0 auto; background: var(--card-bg); padding: 1.5rem; border-radius: 8px; box-shadow: 0 1px 4px var(--shadow); border: 1px solid var(--border); }
        h1 { margin-top: 0; font-size: 1.4rem; color: var(--heading); }
        .row { margin: 1rem 0; }
        .label { font-weight: 600; color: var(--label); font-size: .85rem; text-transform: uppercase; }
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