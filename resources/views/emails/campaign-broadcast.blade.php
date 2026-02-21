<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine }}</title>
    <style>
        body { margin:0; padding:0; background:#f4f5f7; font-family: 'Segoe UI', Arial, sans-serif; }
        .wrapper { width:100%; background:#f4f5f7; padding:30px 0; }
        .container { max-width:640px; margin:0 auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
        .header { background:linear-gradient(135deg, #5e1e28 0%, #822b39 100%); color:#fff; padding:22px 28px; }
        .header h1 { margin:0; font-size:22px; letter-spacing:0.5px; }
        .sub { color:rgba(255,255,255,0.8); margin-top:6px; font-size:13px; }
        .body { padding:28px; color:#1f2937; line-height:1.7; font-size:16px; }
        .body h2 { color:#111827; margin-top:0; }
        .footer { background:#0f172a; color:#e2e8f0; padding:18px 28px; font-size:13px; }
        .footer a { color:#f5c143; text-decoration:none; }
        .btn { display:inline-block; background:#822b39; color:#fff !important; padding:12px 18px; border-radius:8px; text-decoration:none; margin:16px 0; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            <h1>Agenda 2063 Bulletin</h1>
            <div class="sub">{{ $preview ?: 'Updates from the African Union – Agenda 2063' }}</div>
        </div>
        <div class="body">
            {!! $bodyHtml !!}
        </div>
        <div class="footer">
            <div>{{ $footerNote ?: 'You receive this update because you subscribed to Agenda 2063 campaign communications.' }}</div>
            <div style="margin-top:8px;">To opt out, click <a href="#">unsubscribe</a>.</div>
        </div>
    </div>
</div>
</body>
</html>
