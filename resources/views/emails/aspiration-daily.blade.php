@php
    $firstName = trim($subscriber->first_name ?? '');
    $greeting  = $firstName ? "Dear {$firstName}," : "Dear Agenda 2063 Supporter,";

    /* Day-of-week ordinal for the series label */
    $dayNum   = ((now()->dayOfYear - 1) % 7) + 1;  // 1–7, cycles weekly
    $seriesOf = 7;

    /* Hex → RGB for rgba() usage in CSS */
    function hexToRgb(string $hex): string {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        return hexdec(substr($hex,0,2)).','.hexdec(substr($hex,2,2)).','.hexdec(substr($hex,4,2));
    }

    $accentRgb = hexToRgb($aspiration['accent']);
    $colorRgb  = hexToRgb($aspiration['color']);

    $platformUrl = config('app.url');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Agenda 2063 — {{ $aspiration['label'] }}: {{ $aspiration['title'] }}</title>
</head>
<body style="margin:0;padding:0;background:#e8eaee;font-family:'Segoe UI',Helvetica,Arial,sans-serif;">

{{-- ══════════════════════════════════════ OUTER WRAPPER --}}
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e8eaee;padding:32px 0 48px;">
<tr><td align="center">
<table width="660" cellpadding="0" cellspacing="0" border="0" style="max-width:660px;width:100%;">

{{-- ══════════════════════════════════════════════════ PRE-HEADER --}}
{{-- Hidden preview text shown in email clients --}}
<tr>
  <td style="display:none;font-size:1px;color:#e8eaee;max-height:0;overflow:hidden;">
    {{ $aspiration['label'] }} of 7: {{ $aspiration['title'] }} — {{ $aspiration['tagline'] }}
    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
  </td>
</tr>

{{-- ══════════════════════════════════════════════════ HEADER --}}
<tr>
  <td style="background:#071423;border-radius:12px 12px 0 0;overflow:hidden;padding:0;">

    {{-- Top: aspiration-colour accent bar --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td style="height:5px;background:linear-gradient(90deg,{{ $aspiration['color'] }} 0%,{{ $aspiration['accent'] }} 50%,{{ $aspiration['color'] }} 100%);font-size:1px;">&nbsp;</td>
      </tr>
    </table>

    {{-- Header body --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td style="padding:30px 36px 28px;">

          {{-- Series progress pill --}}
          <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
            <tr>
              <td style="background:rgba({{ $accentRgb }},0.15);border:1px solid rgba({{ $accentRgb }},0.40);border-radius:4px;padding:4px 14px;">
                <span style="color:{{ $aspiration['accent'] }};font-size:9.5px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;">Daily Spotlight &nbsp;·&nbsp; {{ $aspiration['label'] }} of {{ $seriesOf }}</span>
              </td>
              <td style="padding-left:12px;">
                <span style="color:rgba(255,255,255,0.35);font-size:10px;">{{ $dayLabel }}</span>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 4px;color:{{ $aspiration['accent'] }};font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;">African Union Commission &nbsp;·&nbsp; Agenda 2063</p>
          <h1 style="margin:0 0 8px;color:#ffffff;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.10em;opacity:.65;">{{ $aspiration['label'] }}</h1>
          <h2 style="margin:0 0 6px;color:#ffffff;font-size:28px;font-weight:800;line-height:1.18;letter-spacing:-.3px;">{{ $aspiration['title'] }}</h2>
          <p style="margin:0 0 18px;color:{{ $aspiration['accent'] }};font-size:14px;font-weight:600;font-style:italic;">{{ $aspiration['subtitle'] }}</p>
          <p style="margin:0;color:rgba(255,255,255,0.55);font-size:13px;line-height:1.65;max-width:460px;">{{ $aspiration['tagline'] }}</p>

        </td>

        {{-- Right: aspiration badge --}}
        <td width="130" valign="middle" align="center" style="padding:28px 28px 28px 0;">
          <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
            <tr>
              <td align="center" style="width:90px;height:90px;border-radius:50%;background:rgba({{ $accentRgb }},0.12);border:2px solid rgba({{ $accentRgb }},0.35);padding:0;line-height:90px;text-align:center;">
                <span style="color:{{ $aspiration['accent'] }};font-size:34px;font-weight:900;line-height:90px;">{{ $aspiration['number'] }}</span>
              </td>
            </tr>
            <tr>
              <td align="center" style="padding-top:9px;">
                <span style="color:rgba(255,255,255,0.28);font-size:8.5px;font-weight:700;letter-spacing:.13em;text-transform:uppercase;">ASPIRATION</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    {{-- Aspiration progress tracker: 7 dots --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td style="background:rgba(0,0,0,0.25);padding:14px 36px;">
          <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
            <tr>
              @for($i = 1; $i <= 7; $i++)
              <td style="padding:0 4px;text-align:center;">
                <div style="width:{{ $i === $aspiration['number'] ? '28' : '20' }}px;
                            height:{{ $i === $aspiration['number'] ? '28' : '20' }}px;
                            border-radius:50%;
                            background:{{ $i === $aspiration['number'] ? $aspiration['accent'] : 'rgba(255,255,255,0.12)' }};
                            border:2px solid {{ $i === $aspiration['number'] ? $aspiration['accent'] : 'rgba(255,255,255,0.20)' }};
                            text-align:center;
                            line-height:{{ $i === $aspiration['number'] ? '24' : '16' }}px;
                            margin:0 auto;">
                  <span style="color:{{ $i === $aspiration['number'] ? '#071423' : 'rgba(255,255,255,0.40)' }};
                               font-size:{{ $i === $aspiration['number'] ? '11' : '9' }}px;
                               font-weight:800;">{{ $i }}</span>
                </div>
              </td>
              @endfor
            </tr>
            <tr>
              <td colspan="7" align="center" style="padding-top:7px;">
                <span style="color:rgba(255,255,255,0.28);font-size:9px;letter-spacing:.08em;">7 ASPIRATIONS OF AGENDA 2063 — YOU ARE ON ASPIRATION {{ $aspiration['number'] }}</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

  </td>
</tr>

{{-- ══════════════════════════════════════════════════ BODY --}}
<tr>
  <td style="background:#ffffff;padding:0;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">

{{-- ─────────────────────────── GREETING + BODY TEXT --}}
    <tr>
      <td style="padding:32px 36px 0;">

        <p style="margin:0 0 6px;color:#374151;font-size:14px;">{{ $greeting }}</p>
        <p style="margin:0 0 20px;color:#6b7280;font-size:13px;line-height:1.6;">
          Welcome to today's <strong style="color:#071423;">Agenda 2063 Daily Spotlight</strong> — your regular window into Africa's 50-year blueprint for transformation.
          Today we explore <strong style="color:{{ $aspiration['color'] }};">{{ $aspiration['label'] }}: {{ $aspiration['title'] }}</strong>.
        </p>

        {{-- Body paragraphs --}}
        @foreach($aspiration['body'] as $para)
        <p style="margin:0 0 14px;color:#374151;font-size:13.5px;line-height:1.75;">{{ $para }}</p>
        @endforeach

      </td>
    </tr>

{{-- ─────────────────────────── PULL QUOTE --}}
    <tr>
      <td style="padding:24px 36px 0;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0"
               style="background:rgba({{ $colorRgb }},0.05);border-left:5px solid {{ $aspiration['accent'] }};border-radius:0 8px 8px 0;">
          <tr>
            <td style="padding:18px 20px;">
              <p style="margin:0 0 8px;color:#071423;font-size:15px;font-style:italic;line-height:1.65;font-weight:500;">
                &ldquo;{{ $aspiration['quote'] }}&rdquo;
              </p>
              <p style="margin:0;color:{{ $aspiration['color'] }};font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">
                — {{ $aspiration['quote_src'] }}
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

{{-- ─────────────────────────── KEY GOALS & PROGRESS --}}
    <tr>
      <td style="padding:30px 36px 0;">

        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:6px;">
          <tr>
            <td style="border-bottom:2px solid #071423;padding-bottom:8px;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
                    <p style="margin:0;color:#071423;font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">Key Goals Under This Aspiration</p>
                  </td>
                  <td align="right">
                    <span style="color:#9ca3af;font-size:10px;">Progress toward 2063 targets</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:16px;">
          @foreach($aspiration['goals'] as $goal)
          <tr>
            <td style="padding-bottom:16px;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
                    <p style="margin:0 0 2px;color:#111827;font-size:12.5px;font-weight:700;">{{ $goal['title'] }}</p>
                    <p style="margin:0 0 6px;color:#6b7280;font-size:11px;">{{ $goal['text'] }}</p>
                    {{-- Progress bar --}}
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e5e7eb;border-radius:4px;height:7px;">
                      <tr>
                        <td width="{{ $goal['progress'] }}%" style="background:{{ $aspiration['accent'] }};border-radius:4px;height:7px;">&nbsp;</td>
                        <td></td>
                      </tr>
                    </table>
                  </td>
                  <td width="42" align="right" valign="top" style="padding-left:10px;">
                    <span style="color:{{ $aspiration['color'] }};font-size:15px;font-weight:800;">{{ $goal['progress'] }}%</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          @endforeach
        </table>

      </td>
    </tr>

{{-- ─────────────────────────── DID YOU KNOW --}}
    <tr>
      <td style="padding:26px 36px 0;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0"
               style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">
          <tr>
            <td style="background:#071423;padding:10px 18px;">
              <p style="margin:0;color:#c8a84b;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.12em;">Did You Know?</p>
            </td>
          </tr>
          @foreach($aspiration['facts'] as $i => $fact)
          <tr>
            <td style="padding:12px 18px {{ $loop->last ? '14px' : '0' }};">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="22" valign="top" style="padding-top:2px;">
                    <div style="width:18px;height:18px;border-radius:50%;background:{{ $aspiration['accent'] }};text-align:center;line-height:18px;">
                      <span style="color:#ffffff;font-size:10px;font-weight:800;">{{ $i + 1 }}</span>
                    </div>
                  </td>
                  <td style="padding-left:10px;color:#374151;font-size:12.5px;line-height:1.65;">{{ $fact }}</td>
                </tr>
              </table>
            </td>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>

{{-- ─────────────────────────── FLAGSHIP PROJECTS --}}
    <tr>
      <td style="padding:26px 36px 0;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:rgba({{ $colorRgb }},0.04);border:1px solid rgba({{ $colorRgb }},0.15);border-radius:10px;">
          <tr>
            <td style="padding:16px 18px 10px;">
              <p style="margin:0 0 12px;color:#071423;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">Related Flagship Projects</p>
              @foreach($aspiration['flagships'] as $fp)
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="{{ !$loop->last ? 'margin-bottom:8px;' : '' }}">
                <tr>
                  <td width="6" valign="middle" style="padding-right:10px;">
                    <div style="width:6px;height:6px;border-radius:50%;background:{{ $aspiration['accent'] }};"></div>
                  </td>
                  <td style="color:#374151;font-size:12.5px;font-weight:500;">{{ $fp }}</td>
                </tr>
              </table>
              @endforeach
            </td>
          </tr>
        </table>
      </td>
    </tr>

{{-- ─────────────────────────── IMPLEMENTATION CONTEXT --}}
    <tr>
      <td style="padding:26px 36px 0;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;">
          <tr style="background:#f8fafc;">
            <td colspan="3" style="padding:12px 18px;border-bottom:1px solid #e5e7eb;">
              <p style="margin:0;color:#374151;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">Implementation Timeline</p>
            </td>
          </tr>
          @php
          $timeline = [
            ['period'=>'2014–2023', 'label'=>'1st Ten-Year Plan', 'note'=>'Foundation & Flagship Launch',    'done'=>true],
            ['period'=>'2024–2033', 'label'=>'2nd Ten-Year Plan', 'note'=>'Acceleration & Industrialisation','done'=>false,'active'=>true],
            ['period'=>'2034–2043', 'label'=>'3rd Ten-Year Plan', 'note'=>'Consolidation & Scale-Up',        'done'=>false],
            ['period'=>'2044–2063', 'label'=>'Final Phase',       'note'=>'Full Vision Realisation',         'done'=>false],
          ];
          @endphp
          @foreach($timeline as $t)
          <tr style="border-bottom:{{ !$loop->last ? '1px solid #e5e7eb' : 'none' }};background:{{ !empty($t['active']) ? 'rgba('.hexToRgb($aspiration['accent']).',0.06)' : '#ffffff' }};">
            <td width="24" style="padding:11px 6px 11px 14px;">
              <div style="width:10px;height:10px;border-radius:50%;background:{{ !empty($t['done']) ? '#9ca3af' : (!empty($t['active']) ? $aspiration['accent'] : '#e5e7eb') }};border:2px solid {{ !empty($t['active']) ? $aspiration['accent'] : '#e5e7eb' }};"></div>
            </td>
            <td style="padding:11px 10px;">
              <span style="color:#6b7280;font-size:10.5px;font-weight:700;">{{ $t['period'] }}</span>&nbsp;
              <span style="color:#111827;font-size:11.5px;font-weight:{{ !empty($t['active']) ? '800' : '500' }};">{{ $t['label'] }}</span>
              @if(!empty($t['active']))
              <span style="background:{{ $aspiration['accent'] }};color:#ffffff;font-size:8.5px;font-weight:700;padding:1px 7px;border-radius:3px;margin-left:6px;text-transform:uppercase;letter-spacing:.05em;">NOW</span>
              @endif
            </td>
            <td align="right" style="padding:11px 16px;color:#9ca3af;font-size:11px;">{{ $t['note'] }}</td>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>

{{-- ─────────────────────────── CTA BUTTON --}}
    <tr>
      <td style="padding:30px 36px 28px;text-align:center;">
        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 16px;">
          <tr>
            <td style="background:{{ $aspiration['color'] }};border-radius:6px;padding:14px 36px;text-align:center;">
              <a href="{{ $platformUrl }}/aspirations/{{ \Illuminate\Support\Str::slug($aspiration['title']) }}"
                 style="color:#ffffff;font-size:13px;font-weight:700;text-decoration:none;letter-spacing:.04em;white-space:nowrap;">
                Explore {{ $aspiration['label'] }} on the Platform &rarr;
              </a>
            </td>
          </tr>
        </table>
        <p style="margin:0;color:#9ca3af;font-size:11px;">
          Or visit
          <a href="{{ $platformUrl }}/about#goals" style="color:{{ $aspiration['color'] }};text-decoration:none;font-weight:600;">{{ $platformUrl }}/about</a>
          to read more about all 7 aspirations and Agenda 2063's goals.
        </p>
      </td>
    </tr>

{{-- ─────────────────────────── SERIES NAVIGATOR --}}
    <tr>
      <td style="padding:0 36px 32px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:16px;">
          <tr>
            <td style="padding:0 0 12px;">
              <p style="margin:0;color:#374151;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.10em;">The 7 Aspirations of Agenda 2063</p>
            </td>
          </tr>
          @php
          $allAspirations = \App\Console\Commands\SendDailyAspirationBroadcast::aspirations();
          @endphp
          @foreach($allAspirations as $a)
          <tr>
            <td style="padding:5px 0;{{ !$loop->last ? 'border-bottom:1px solid #e5e7eb;' : '' }}">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="24" style="padding-right:8px;">
                    <div style="width:20px;height:20px;border-radius:50%;background:{{ $a['number'] === $aspiration['number'] ? $aspiration['accent'] : '#e5e7eb' }};text-align:center;line-height:20px;">
                      <span style="color:{{ $a['number'] === $aspiration['number'] ? '#071423' : '#6b7280' }};font-size:10px;font-weight:800;">{{ $a['number'] }}</span>
                    </div>
                  </td>
                  <td>
                    <span style="color:{{ $a['number'] === $aspiration['number'] ? $aspiration['color'] : '#6b7280' }};
                                 font-size:12px;
                                 font-weight:{{ $a['number'] === $aspiration['number'] ? '700' : '400' }};">
                      {{ $a['title'] }}
                      @if($a['number'] === $aspiration['number'])
                        <span style="background:{{ $aspiration['color'] }};color:#fff;font-size:8.5px;font-weight:700;padding:1px 7px;border-radius:3px;margin-left:5px;text-transform:uppercase;letter-spacing:.05em;">TODAY</span>
                      @endif
                    </span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>

  </table>
  </td>
</tr>

{{-- ══════════════════════════════════════════════════ FOOTER --}}
<tr>
  <td style="background:#071423;border-radius:0 0 12px 12px;overflow:hidden;">

    {{-- Aspiration-colour accent --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr><td style="height:3px;background:linear-gradient(90deg,{{ $aspiration['color'] }} 0%,{{ $aspiration['accent'] }} 50%,{{ $aspiration['color'] }} 100%);font-size:1px;">&nbsp;</td></tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        {{-- Left: org branding --}}
        <td valign="top" style="padding:24px 28px 20px 30px;border-right:1px solid rgba(255,255,255,0.07);">

          <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:12px;">
            <tr>
              <td style="background:rgba(200,168,75,0.13);border:1px solid rgba(200,168,75,0.28);border-radius:4px;padding:4px 11px;">
                <span style="color:#c8a84b;font-size:9.5px;font-weight:800;letter-spacing:.12em;">ICD</span>
              </td>
              <td width="7">&nbsp;</td>
              <td style="background:rgba(200,168,75,0.13);border:1px solid rgba(200,168,75,0.28);border-radius:4px;padding:4px 11px;">
                <span style="color:#c8a84b;font-size:9.5px;font-weight:800;letter-spacing:.12em;">AUDA-NEPAD</span>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 2px;color:#ffffff;font-size:12px;font-weight:700;">Information Communication Directorate (ICD)</p>
          <p style="margin:0 0 14px;color:rgba(255,255,255,0.48);font-size:11px;">African Union Development Agency — NEPAD (AUDA-NEPAD)</p>

          <p style="margin:0;color:rgba(255,255,255,0.28);font-size:10px;line-height:1.7;border-top:1px solid rgba(255,255,255,0.08);padding-top:10px;">
            You are receiving this email because you subscribed to the<br>
            Agenda 2063 newsletter. This is an automated daily broadcast.
          </p>

        </td>

        {{-- Right: support team --}}
        <td valign="top" style="padding:24px 30px 20px 28px;text-align:right;">
          <p style="margin:0 0 6px;color:#c8a84b;font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:.12em;">Supported by</p>
          <p style="margin:0 0 4px;color:#ffffff;font-size:13px;font-weight:800;line-height:1.4;">
            Agenda 2063<br>Technical Support Team
          </p>
          <p style="margin:0 0 16px;color:rgba(255,255,255,0.32);font-size:10px;">platform@agenda2063.africa</p>

          <table cellpadding="0" cellspacing="0" border="0" style="float:right;">
            <tr>
              <td style="background:rgba({{ $accentRgb }},0.14);border:1px solid rgba({{ $accentRgb }},0.35);border-radius:4px;padding:5px 13px;text-align:center;">
                <span style="color:{{ $aspiration['accent'] }};font-size:9px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;">The Africa We Want</span>
              </td>
            </tr>
          </table>

        </td>
      </tr>
    </table>

    {{-- Bottom bar --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td style="background:#030c18;padding:10px 30px;text-align:center;">
          <span style="color:rgba(255,255,255,0.20);font-size:9.5px;letter-spacing:.03em;">
            &copy; {{ date('Y') }} African Union Commission &nbsp;&#183;&nbsp; Agenda 2063 Platform
            &nbsp;&#183;&nbsp; {{ $aspiration['label'] }} Daily Spotlight
            &nbsp;&#183;&nbsp; {{ now()->format('d M Y') }}
          </span>
        </td>
      </tr>
    </table>

  </td>
</tr>

</table>{{-- /660px wrapper --}}
</td></tr>
</table>{{-- /outer --}}

</body>
</html>
