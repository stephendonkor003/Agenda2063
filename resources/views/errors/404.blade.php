<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body { font-family: Arial, sans-serif; background:#0f172a; color:#e2e8f0; margin:0; display:flex; align-items:center; justify-content:center; height:100vh; }
        .card { background:#111827; padding:32px; border-radius:14px; box-shadow:0 20px 60px rgba(0,0,0,0.35); max-width:520px; width:92%; text-align:center; }
        h1 { margin:0 0 8px; font-size:32px; letter-spacing:1px; }
        p { margin:6px 0 14px; color:#cbd5e1; }
        .muted { color:#94a3b8; font-size:14px; }
        .btn { display:inline-block; margin-top:14px; padding:10px 16px; border-radius:10px; text-decoration:none; color:#0f172a; background:#38bdf8; font-weight:600; }
        .count { font-size:20px; font-weight:700; color:#f97316; }
    </style>
</head>
<body>
    <div class="card">
        <h1>404 • Page Not Found</h1>
        <p>The page you requested does not exist or has been moved.</p>
        <p class="muted">For security, you will be redirected shortly.</p>
        <div class="count">Redirecting in <span id="count">10</span>s…</div>
        <a class="btn" href="{{ url('/') }}">Go to Homepage</a>
        @auth
        <form id="logoutForm404" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
        @endauth
    </div>

    <script>
    (function() {
        let remaining = 10;
        const el = document.getElementById('count');
        const tick = setInterval(() => {
            remaining--;
            el.textContent = remaining;
            if (remaining <= 0) {
                clearInterval(tick);
                @auth
                    document.getElementById('logoutForm404').submit();
                @else
                    window.location.href = "{{ url('/') }}";
                @endauth
            }
        }, 1000);
    })();
    </script>
</body>
</html>
