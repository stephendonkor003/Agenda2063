@php
    /* ── Helpers ───────────────────────────────────────────────────── */
    function fmtBytes(int $bytes): string {
        if ($bytes <= 0) return '—';
        $units = ['B','KB','MB','GB','TB'];
        $i = (int) floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 1) . ' ' . $units[$i];
    }

    function fmtDuration(int $secs): string {
        if ($secs <= 0) return '0s';
        if ($secs < 60)   return "{$secs}s";
        if ($secs < 3600) return floor($secs / 60) . 'm ' . ($secs % 60) . 's';
        return floor($secs / 3600) . 'h ' . floor(($secs % 3600) / 60) . 'm';
    }

    /* ── Status indicators ─────────────────────────────────────────── */
    $diskOk    = $d['server']['disk_used_pct'] < 85;
    $failedOk  = $d['queue']['failed_jobs'] === 0;
    $queueOk   = $d['queue']['pending_jobs'] < 200;
    $overallOk = $diskOk && $failedOk && $queueOk;

    $alertCount = (!$diskOk ? 1 : 0) + (!$failedOk ? 1 : 0) + (!$queueOk ? 1 : 0);

    /* Reference number for traceability */
    $refNo = 'RPT-' . $d['generated_at']->format('Ymd-Hi');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Agenda 2063 — Platform Intelligence Report {{ $refNo }}</title>
</head>
<body style="margin:0;padding:0;background:#dde1e8;font-family:'Segoe UI',Helvetica,Arial,sans-serif;">

{{-- ══════════════════════════════════════════════ OUTER WRAPPER --}}
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#dde1e8;padding:36px 0 48px;">
<tr><td align="center">

<table width="680" cellpadding="0" cellspacing="0" border="0" style="max-width:680px;width:100%;">

{{-- ══════════════════════════════════════════════════════ HEADER --}}
<tr>
  <td style="background:#071423;border-radius:12px 12px 0 0;padding:0;overflow:hidden;">

    {{-- Top gold rule --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="6" style="background:#c8a84b;">&nbsp;</td>
        <td style="background:#c8a84b;opacity:.55;">&nbsp;</td>
        <td width="6" style="background:#c8a84b;">&nbsp;</td>
      </tr>
      <tr><td colspan="3" style="height:4px;background:linear-gradient(90deg,#b8962a 0%,#f0d070 50%,#b8962a 100%);font-size:1px;">&nbsp;</td></tr>
    </table>

    {{-- Header body --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        {{-- Left: titles --}}
        <td style="padding:34px 36px 30px;">

          {{-- Classification tag --}}
          <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
            <tr>
              <td style="background:rgba(200,168,75,0.14);border:1px solid rgba(200,168,75,0.40);border-radius:4px;padding:4px 13px;">
                <span style="color:#d4af55;font-size:9.5px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;">CONFIDENTIAL &nbsp;·&nbsp; EXECUTIVE BRIEFING</span>
              </td>
              <td style="padding-left:14px;">
                <span style="color:rgba(255,255,255,0.38);font-size:10px;letter-spacing:.04em;">Ref: {{ $refNo }}</span>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 4px;color:#c8a84b;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;">African Union Commission</p>
          <h1 style="margin:0 0 6px;color:#ffffff;font-size:26px;font-weight:800;line-height:1.2;letter-spacing:-.2px;">
            Agenda 2063 Platform<br>
            <span style="color:#c8a84b;">Intelligence Report</span>
          </h1>
          <p style="margin:0 0 22px;color:rgba(255,255,255,0.50);font-size:12px;line-height:1.6;">
            Issued: <strong style="color:rgba(255,255,255,0.75);">{{ $d['generated_at']->format('l, d F Y') }}</strong>
            &nbsp;at&nbsp; <strong style="color:rgba(255,255,255,0.75);">{{ $d['generated_at']->format('H:i \U\T\C') }}</strong>
            &nbsp;&nbsp;|&nbsp;&nbsp; Reporting period: <strong style="color:#c8a84b;">Last {{ $d['period_hours'] }} hours</strong>
          </p>

          {{-- System status pill --}}
          @if($overallOk)
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td style="background:#064e2b;border:1px solid #16a34a;border-radius:6px;padding:9px 20px;">
                <span style="color:#4ade80;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;">
                  &#10003;&nbsp; ALL SYSTEMS OPERATIONAL
                </span>
              </td>
            </tr>
          </table>
          @else
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td style="background:#4c0519;border:1px solid #dc2626;border-radius:6px;padding:9px 20px;">
                <span style="color:#fca5a5;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;">
                  &#9888;&nbsp; {{ $alertCount }} ISSUE{{ $alertCount > 1 ? 'S' : '' }} REQUIRING ATTENTION
                </span>
              </td>
            </tr>
          </table>
          @endif

        </td>

        {{-- Right: AU emblem --}}
        <td width="140" valign="middle" align="center" style="padding:30px 30px 30px 0;">
          <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
            <tr>
              <td align="center" style="width:96px;height:96px;border-radius:50%;background:rgba(200,168,75,0.10);border:2px solid rgba(200,168,75,0.30);padding:0;">
                <div style="font-size:38px;line-height:96px;">&#127757;</div>
              </td>
            </tr>
            <tr>
              <td align="center" style="padding-top:10px;">
                <span style="color:rgba(255,255,255,0.28);font-size:8.5px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;">AGENDA&nbsp;2063</span>
              </td>
            </tr>
            <tr>
              <td align="center" style="padding-top:4px;">
                <span style="color:#c8a84b;font-size:8px;font-weight:600;letter-spacing:.08em;">The Africa We Want</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>

{{-- ══════════════════════════════════ ACTION-REQUIRED ALERT BANNER --}}
@if(!$overallOk)
<tr>
  <td style="background:#7f1d1d;padding:14px 36px;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
          <p style="margin:0;color:#fecaca;font-size:12px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;">Action Required</p>
          <p style="margin:4px 0 0;color:rgba(254,202,202,0.80);font-size:11px;line-height:1.6;">
            @if(!$diskOk) &#9679; Disk utilisation has exceeded the 85% threshold and requires immediate review.<br>@endif
            @if(!$failedOk) &#9679; {{ number_format($d['queue']['failed_jobs']) }} failed job(s) detected in the processing queue — immediate investigation recommended.<br>@endif
            @if(!$queueOk) &#9679; Job queue backlog exceeds acceptable limits ({{ number_format($d['queue']['pending_jobs']) }} pending). Verify queue workers are operational.@endif
          </p>
        </td>
        <td width="60" align="right" valign="middle">
          <div style="background:rgba(255,255,255,0.12);border-radius:50%;width:44px;height:44px;text-align:center;line-height:44px;font-size:22px;">&#9888;</div>
        </td>
      </tr>
    </table>
  </td>
</tr>
@endif

{{-- ══════════════════════════════════════════════ EXECUTIVE SNAPSHOT --}}
<tr>
  <td style="background:#0d1f38;padding:0 36px;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid rgba(255,255,255,0.07);">

      {{-- Section label --}}
      <tr>
        <td colspan="4" style="padding:18px 0 6px;">
          <p style="margin:0;color:rgba(255,255,255,0.30);font-size:9.5px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;">Executive Snapshot &mdash; Last {{ $d['period_hours'] }} Hours</p>
        </td>
      </tr>

      {{-- KPI row --}}
      <tr>
        @php
        $kpis = [
          ['label'=>'Platform Sessions',  'value'=>number_format($d['analytics']['sessions_period']),            'note'=>number_format($d['analytics']['all_time_sessions']).' all-time',   'accent'=>'#38bdf8'],
          ['label'=>'Page Views',         'value'=>number_format($d['analytics']['pageviews_period']),           'note'=>number_format($d['analytics']['all_time_pageviews']).' all-time',  'accent'=>'#34d399'],
          ['label'=>'Avg. Engagement',    'value'=>fmtDuration($d['analytics']['avg_session_seconds']),         'note'=>'average time on platform',                                        'accent'=>'#f59e0b'],
          ['label'=>'New Subscribers',    'value'=>number_format($d['subscribers']['new_period']),              'note'=>number_format($d['subscribers']['total']).' total mailing list',   'accent'=>'#a78bfa'],
        ];
        @endphp
        @foreach($kpis as $k)
        <td width="25%" valign="top"
            style="padding:10px {{ $loop->last ? '0' : '10px' }} 22px {{ $loop->first ? '0' : '10px' }};
                   border-right:{{ $loop->last ? 'none' : '1px solid rgba(255,255,255,0.06)' }};
                   text-align:center;">
          <div style="color:{{ $k['accent'] }};font-size:26px;font-weight:800;line-height:1;margin-bottom:5px;">{{ $k['value'] }}</div>
          <div style="color:#ffffff;font-size:10px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;margin-bottom:4px;">{{ $k['label'] }}</div>
          <div style="color:rgba(255,255,255,0.32);font-size:9.5px;">{{ $k['note'] }}</div>
        </td>
        @endforeach
      </tr>

    </table>
  </td>
</tr>

{{-- ══════════════════════════════════════════════════ MAIN BODY --}}
<tr>
  <td style="background:#ffffff;padding:0;border-radius:0 0 12px 12px;">

    {{-- ─── Inner content wrapper ─── --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">

{{-- ═══════════════════════════ SECTION: PLATFORM HEALTH DASHBOARD --}}
      <tr>
        <td style="padding:32px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            {{-- Section heading --}}
            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;margin-bottom:16px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">01 &mdash; Platform Health Dashboard</p>
                    </td>
                    <td align="right">
                      <span style="background:{{ $overallOk ? '#ecfdf5' : '#fef2f2' }};color:{{ $overallOk ? '#15803d' : '#b91c1c' }};border:1px solid {{ $overallOk ? '#86efac' : '#fca5a5' }};border-radius:4px;font-size:10px;font-weight:700;padding:3px 10px;letter-spacing:.06em;text-transform:uppercase;">
                        {{ $overallOk ? 'NOMINAL' : 'ALERT' }}
                      </span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            {{-- Health indicator grid --}}
            <tr>
              <td style="padding-top:18px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    @php
                    $health = [
                      ['label'=>'Disk Utilisation', 'val'=>$d['server']['disk_used_pct'].'%',    'ok'=>$diskOk,   'desc'=>fmtBytes($d['server']['disk_free']).' free of '.fmtBytes($d['server']['disk_total'])],
                      ['label'=>'Queue Operations', 'val'=>$d['queue']['pending_jobs'].' pending','ok'=>$queueOk,  'desc'=>'Threshold: 200 jobs'],
                      ['label'=>'Failed Jobs',       'val'=>$d['queue']['failed_jobs'].' failed', 'ok'=>$failedOk, 'desc'=>'Zero failures expected'],
                      ['label'=>'Active Users',      'val'=>number_format($d['users']['active_period']).' active',       'ok'=>true,           'desc'=>number_format($d['users']['total']).' total registered'],
                    ];
                    @endphp
                    @foreach($health as $h)
                    <td width="25%" valign="top" style="padding-right:{{ $loop->last ? '0' : '10px' }};">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td style="background:{{ $h['ok'] ? '#f0fdf4' : '#fff7f7' }};border:1px solid {{ $h['ok'] ? '#bbf7d0' : '#fecaca' }};border-radius:8px;padding:14px;text-align:center;">
                            <div style="width:10px;height:10px;border-radius:50%;background:{{ $h['ok'] ? '#16a34a' : '#dc2626' }};margin:0 auto 8px;"></div>
                            <div style="color:{{ $h['ok'] ? '#15803d' : '#b91c1c' }};font-size:13px;font-weight:800;line-height:1.2;margin-bottom:5px;">{{ $h['val'] }}</div>
                            <div style="color:#374151;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">{{ $h['label'] }}</div>
                            <div style="color:#9ca3af;font-size:9.5px;">{{ $h['desc'] }}</div>
                          </td>
                        </tr>
                      </table>
                    </td>
                    @endforeach
                  </tr>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>

{{-- ═══════════════════════════ SECTION: TRAFFIC & ENGAGEMENT --}}
      <tr>
        <td style="padding:30px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;">
                <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">02 &mdash; Traffic &amp; Engagement Analytics</p>
              </td>
            </tr>

            <tr>
              <td style="padding-top:16px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                  <tr style="background:#0a1628;">
                    <th style="text-align:left;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Metric</th>
                    <th style="text-align:right;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Period ({{ $d['period_hours'] }}h)</th>
                    <th style="text-align:right;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Cumulative</th>
                    <th style="text-align:center;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Status</th>
                  </tr>
                  @php
                  $metrics = [
                    ['label'=>'Unique Sessions',       'period'=>$d['analytics']['sessions_period'],   'total'=>$d['analytics']['all_time_sessions'],   'active'=>$d['analytics']['sessions_period'] > 0],
                    ['label'=>'Page Views',            'period'=>$d['analytics']['pageviews_period'],  'total'=>$d['analytics']['all_time_pageviews'],  'active'=>$d['analytics']['pageviews_period'] > 0],
                    ['label'=>'Document Downloads',    'period'=>$d['analytics']['downloads'],         'total'=>null,                                   'active'=>$d['analytics']['downloads'] > 0],
                    ['label'=>'Campaign Subscriptions','period'=>$d['analytics']['subscriptions'],     'total'=>$d['subscribers']['total'],             'active'=>$d['analytics']['subscriptions'] > 0],
                    ['label'=>'Quiz Interactions',     'period'=>$d['analytics']['quiz_interactions'], 'total'=>null,                                   'active'=>$d['analytics']['quiz_interactions'] > 0],
                  ];
                  @endphp
                  @foreach($metrics as $m)
                  <tr style="background:{{ $loop->odd ? '#f9fafb' : '#ffffff' }};border-top:1px solid #e5e7eb;">
                    <td style="padding:11px 16px;color:#111827;font-size:12.5px;font-weight:500;">{{ $m['label'] }}</td>
                    <td style="padding:11px 16px;text-align:right;color:#111827;font-size:14px;font-weight:800;">{{ number_format($m['period']) }}</td>
                    <td style="padding:11px 16px;text-align:right;color:#6b7280;font-size:12px;">
                      {{ $m['total'] !== null ? number_format($m['total']) : '—' }}
                    </td>
                    <td style="padding:11px 16px;text-align:center;">
                      @if($m['active'])
                        <span style="background:#ecfdf5;color:#15803d;border:1px solid #86efac;border-radius:4px;font-size:9.5px;font-weight:700;padding:2px 9px;letter-spacing:.05em;">ACTIVE</span>
                      @else
                        <span style="background:#f3f4f6;color:#9ca3af;border:1px solid #e5e7eb;border-radius:4px;font-size:9.5px;font-weight:700;padding:2px 9px;letter-spacing:.05em;">NONE</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>

{{-- ═══════════════════════════ SECTION: GEOGRAPHIC REACH --}}
      @if($d['top_countries']->isNotEmpty())
      <tr>
        <td style="padding:30px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">03 &mdash; Geographic Reach</p>
                    </td>
                    <td align="right">
                      <span style="color:#6b7280;font-size:10px;">Top {{ $d['top_countries']->count() }} countries &mdash; last {{ $d['period_hours'] }} hours</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td style="padding-top:16px;">
                @php $totalCtSessions = $d['top_countries']->sum('visits'); @endphp
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                  <tr style="background:#0a1628;">
                    <th style="text-align:center;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;width:36px;">#</th>
                    <th style="text-align:left;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Country / Region</th>
                    <th style="text-align:right;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Sessions</th>
                    <th style="text-align:right;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;width:110px;">Share</th>
                  </tr>
                  @foreach($d['top_countries'] as $i => $ct)
                  @php $pct = $totalCtSessions > 0 ? round(($ct->visits / $totalCtSessions) * 100, 1) : 0; @endphp
                  <tr style="background:{{ ($i % 2 === 0) ? '#f9fafb' : '#ffffff' }};border-top:1px solid #e5e7eb;">
                    <td style="padding:10px 14px;text-align:center;color:#9ca3af;font-size:11px;font-weight:700;">{{ $i + 1 }}</td>
                    <td style="padding:10px 14px;color:#111827;font-size:12.5px;font-weight:600;">
                      {{ ucwords(strtolower($ct->country ?? 'Unknown')) }}
                    </td>
                    <td style="padding:10px 14px;text-align:right;color:#111827;font-size:14px;font-weight:800;">{{ number_format($ct->visits) }}</td>
                    <td style="padding:10px 16px 10px 10px;text-align:right;">
                      <table cellpadding="0" cellspacing="0" border="0" style="float:right;width:90px;">
                        <tr>
                          <td style="padding-bottom:3px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e5e7eb;border-radius:3px;height:5px;">
                              <tr>
                                <td width="{{ max(2,$pct) }}%" style="background:#1d4ed8;border-radius:3px;height:5px;">&nbsp;</td>
                                <td></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" style="color:#6b7280;font-size:10px;font-weight:600;">{{ $pct }}%</td>
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
      @endif

{{-- ═══════════════════════════ SECTION: CONTENT PERFORMANCE --}}
      @if($d['top_pages']->isNotEmpty())
      <tr>
        <td style="padding:30px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">04 &mdash; Content Performance</p>
                    </td>
                    <td align="right">
                      <span style="color:#6b7280;font-size:10px;">Most visited pages &mdash; last {{ $d['period_hours'] }} hours</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td style="padding-top:16px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                  <tr style="background:#0a1628;">
                    <th style="text-align:center;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;width:36px;">#</th>
                    <th style="text-align:left;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Page / URL Path</th>
                    <th style="text-align:right;padding:11px 14px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Page Views</th>
                  </tr>
                  @foreach($d['top_pages'] as $i => $pg)
                  <tr style="background:{{ ($i % 2 === 0) ? '#f9fafb' : '#ffffff' }};border-top:1px solid #e5e7eb;">
                    <td style="padding:10px 14px;text-align:center;color:#9ca3af;font-size:11px;font-weight:700;">{{ $i + 1 }}</td>
                    <td style="padding:10px 14px;color:#374151;font-size:12px;font-family:'Courier New',Courier,monospace;">
                      /{{ ltrim($pg->path, '/') ?: '(home)' }}
                    </td>
                    <td style="padding:10px 14px;text-align:right;color:#1d4ed8;font-size:14px;font-weight:800;">{{ number_format($pg->views) }}</td>
                  </tr>
                  @endforeach
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>
      @endif

{{-- ═══════════════════════════ SECTION: INFRASTRUCTURE & SECURITY --}}
      <tr>
        <td style="padding:30px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">05 &mdash; Infrastructure &amp; Security</p>
                    </td>
                    <td align="right">
                      <span style="background:{{ $diskOk ? '#ecfdf5' : '#fef2f2' }};color:{{ $diskOk ? '#15803d' : '#b91c1c' }};border:1px solid {{ $diskOk ? '#86efac' : '#fca5a5' }};border-radius:4px;font-size:10px;font-weight:700;padding:3px 10px;letter-spacing:.06em;text-transform:uppercase;">{{ $diskOk ? 'HEALTHY' : 'ALERT' }}</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td style="padding-top:16px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>

                    {{-- Disk usage --}}
                    <td width="48%" valign="top" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:18px;">
                      <p style="margin:0 0 12px;color:#374151;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.10em;">Storage Capacity</p>
                      @if($d['server']['disk_total'] > 0)
                        {{-- Progress bar --}}
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e5e7eb;border-radius:4px;height:8px;margin-bottom:10px;">
                          <tr>
                            <td width="{{ min(100,$d['server']['disk_used_pct']) }}%" style="background:{{ $diskOk ? '#16a34a' : '#dc2626' }};border-radius:4px;height:8px;">&nbsp;</td>
                            <td></td>
                          </tr>
                        </table>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td>
                              <span style="color:#111827;font-size:24px;font-weight:800;">{{ $d['server']['disk_used_pct'] }}%</span>
                              <span style="color:#9ca3af;font-size:11px;margin-left:4px;">utilised</span>
                            </td>
                            <td align="right">
                              <span style="color:{{ $diskOk ? '#15803d' : '#dc2626' }};font-size:10px;font-weight:700;background:{{ $diskOk ? '#ecfdf5' : '#fef2f2' }};border-radius:4px;padding:3px 8px;">{{ $diskOk ? 'OK' : 'CRITICAL' }}</span>
                            </td>
                          </tr>
                        </table>
                        <p style="margin:8px 0 0;color:#9ca3af;font-size:10.5px;line-height:1.5;">
                          {{ fmtBytes($d['server']['disk_total'] - $d['server']['disk_free']) }} used
                          &nbsp;/&nbsp; {{ fmtBytes($d['server']['disk_total']) }} total
                          &nbsp;/&nbsp; {{ fmtBytes($d['server']['disk_free']) }} available
                        </p>
                      @else
                        <p style="margin:0;color:#9ca3af;font-size:12px;">Disk metrics unavailable in current environment.</p>
                      @endif
                    </td>

                    <td width="4%">&nbsp;</td>

                    {{-- Runtime specs --}}
                    <td width="48%" valign="top" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:18px;">
                      <p style="margin:0 0 12px;color:#374151;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.10em;">Runtime Environment</p>
                      @php
                      $specs = [
                        ['k'=>'PHP Version',       'v'=>$d['server']['php_version']],
                        ['k'=>'Memory Limit',      'v'=>$d['server']['memory_limit']],
                        ['k'=>'App Environment',   'v'=>strtoupper($d['server']['app_env'])],
                        ['k'=>'Platform URL',      'v'=>$d['server']['app_url']],
                        ['k'=>'Registered Users',  'v'=>number_format($d['users']['total'])],
                      ];
                      @endphp
                      @foreach($specs as $s)
                      <table width="100%" cellpadding="0" cellspacing="0" border="0"
                             style="{{ !$loop->last ? 'border-bottom:1px solid #e5e7eb;' : '' }}padding:6px 0;">
                        <tr>
                          <td style="color:#6b7280;font-size:11px;">{{ $s['k'] }}</td>
                          <td align="right" style="color:#111827;font-size:11px;font-weight:700;">{{ $s['v'] }}</td>
                        </tr>
                      </table>
                      @endforeach
                    </td>

                  </tr>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>

{{-- ═══════════════════════════ SECTION: QUEUE & OPERATIONS --}}
      <tr>
        <td style="padding:30px 36px 0;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">

            <tr>
              <td style="border-bottom:2px solid #0a1628;padding-bottom:8px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      <p style="margin:0;color:#071423;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">06 &mdash; Queue &amp; Operations</p>
                    </td>
                    <td align="right">
                      <span style="background:{{ ($failedOk && $queueOk) ? '#ecfdf5' : '#fef2f2' }};color:{{ ($failedOk && $queueOk) ? '#15803d' : '#b91c1c' }};border:1px solid {{ ($failedOk && $queueOk) ? '#86efac' : '#fca5a5' }};border-radius:4px;font-size:10px;font-weight:700;padding:3px 10px;letter-spacing:.06em;text-transform:uppercase;">{{ ($failedOk && $queueOk) ? 'HEALTHY' : 'ALERT' }}</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td style="padding-top:16px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;">
                  <tr style="background:#0a1628;">
                    <th style="text-align:left;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Indicator</th>
                    <th style="text-align:center;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Value</th>
                    <th style="text-align:center;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Threshold</th>
                    <th style="text-align:center;padding:11px 16px;color:rgba(255,255,255,0.60);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Status</th>
                  </tr>
                  @php
                  $ops = [
                    ['label'=>'Jobs Pending in Queue', 'value'=>number_format($d['queue']['pending_jobs']), 'threshold'=>'&lt; 200', 'ok'=>$queueOk],
                    ['label'=>'Failed Jobs (total)',    'value'=>number_format($d['queue']['failed_jobs']),  'threshold'=>'0',        'ok'=>$failedOk],
                    ['label'=>'Users Active (period)',  'value'=>number_format($d['users']['active_period']),'threshold'=>'—',        'ok'=>true],
                    ['label'=>'New Subscribers (period)','value'=>number_format($d['subscribers']['new_period']),'threshold'=>'—',   'ok'=>true],
                  ];
                  @endphp
                  @foreach($ops as $op)
                  <tr style="background:{{ $loop->odd ? '#f9fafb' : '#ffffff' }};border-top:1px solid #e5e7eb;">
                    <td style="padding:11px 16px;color:#111827;font-size:12.5px;">{{ $op['label'] }}</td>
                    <td style="padding:11px 16px;text-align:center;color:#111827;font-size:14px;font-weight:800;">{{ $op['value'] }}</td>
                    <td style="padding:11px 16px;text-align:center;color:#6b7280;font-size:12px;">{!! $op['threshold'] !!}</td>
                    <td style="padding:11px 16px;text-align:center;">
                      @if($op['ok'])
                        <span style="background:#ecfdf5;color:#15803d;border:1px solid #86efac;border-radius:4px;font-size:9.5px;font-weight:700;padding:2px 9px;letter-spacing:.05em;">OK</span>
                      @else
                        <span style="background:#fef2f2;color:#b91c1c;border:1px solid #fca5a5;border-radius:4px;font-size:9.5px;font-weight:700;padding:2px 9px;letter-spacing:.05em;">ALERT</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </table>
              </td>
            </tr>

            {{-- Failed jobs detail --}}
            @if($d['queue']['recent_failed']->isNotEmpty())
            <tr>
              <td style="padding-top:14px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#fffbeb;border:1px solid #fcd34d;border-radius:8px;overflow:hidden;">
                  <tr>
                    <td style="background:#78350f;padding:10px 16px;">
                      <p style="margin:0;color:#fef3c7;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.10em;">Recent Failed Jobs &mdash; Requires Investigation</p>
                    </td>
                  </tr>
                  @foreach($d['queue']['recent_failed'] as $fj)
                  <tr>
                    <td style="padding:12px 16px;{{ !$loop->last ? 'border-bottom:1px solid #fcd34d;' : '' }}">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td>
                            <span style="color:#92400e;font-size:12px;font-weight:700;">{{ $fj['job'] }}</span>
                            <span style="color:#b45309;font-size:10px;margin-left:8px;">Queue: {{ $fj['queue'] }}</span>
                          </td>
                          <td align="right">
                            <span style="color:#9ca3af;font-size:10px;">{{ $fj['failed_at'] }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" style="padding-top:5px;">
                            <p style="margin:0;color:#b45309;font-size:10.5px;font-family:'Courier New',Courier,monospace;line-height:1.5;word-break:break-word;">{{ $fj['exception'] }}</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </td>
            </tr>
            @else
            <tr>
              <td style="padding-top:12px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f0fdf4;border:1px solid #86efac;border-radius:8px;">
                  <tr>
                    <td style="padding:12px 16px;text-align:center;">
                      <span style="color:#15803d;font-size:12px;font-weight:600;">&#10003;&nbsp; No failed jobs detected — all background operations running normally.</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            @endif

          </table>
        </td>
      </tr>

{{-- ═══════════════════════════ DISCLAIMER NOTE --}}
      <tr>
        <td style="padding:28px 36px 32px;">
          <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f0f9ff;border-left:4px solid #1d4ed8;border-radius:0 6px 6px 0;">
            <tr>
              <td style="padding:14px 18px;">
                <p style="margin:0;color:#1e40af;font-size:11px;line-height:1.7;">
                  <strong>Note to Recipients:</strong> This report is generated automatically every 5 hours by the Agenda 2063 Platform Monitoring System. Analytics data reflects visitor activity captured through the platform's built-in telemetry. For further investigation, access the Admin Dashboard directly. If any indicators show <strong>ALERT</strong> status, please escalate to the Technical Support Team immediately.
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>

    </table>
    {{-- /inner content wrapper --}}

  </td>
</tr>
{{-- /main body --}}

{{-- ══════════════════════════════════════════════════════ FOOTER --}}
<tr>
  <td style="background:#071423;border-radius:0 0 12px 12px;overflow:hidden;">

    {{-- Gold accent line --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr><td style="height:3px;background:linear-gradient(90deg,#b8962a 0%,#f0d070 50%,#b8962a 100%);font-size:1px;">&nbsp;</td></tr>
    </table>

    {{-- Footer logos / org names --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>

        {{-- Left column --}}
        <td valign="top" style="padding:26px 28px 22px 30px;border-right:1px solid rgba(255,255,255,0.07);">

          {{-- Org badges --}}
          <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:14px;">
            <tr>
              <td style="background:rgba(200,168,75,0.12);border:1px solid rgba(200,168,75,0.28);border-radius:4px;padding:4px 11px;">
                <span style="color:#c8a84b;font-size:9.5px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;">ICD</span>
              </td>
              <td width="8">&nbsp;</td>
              <td style="background:rgba(200,168,75,0.12);border:1px solid rgba(200,168,75,0.28);border-radius:4px;padding:4px 11px;">
                <span style="color:#c8a84b;font-size:9.5px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;">AUDA-NEPAD</span>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 2px;color:#ffffff;font-size:12px;font-weight:700;">Information Communication Directorate (ICD)</p>
          <p style="margin:0 0 12px;color:rgba(255,255,255,0.50);font-size:11px;">African Union Development Agency — NEPAD (AUDA-NEPAD)</p>
          <p style="margin:0;color:rgba(255,255,255,0.28);font-size:10px;line-height:1.7;border-top:1px solid rgba(255,255,255,0.08);padding-top:10px;">
            This communication is addressed to registered platform administrators.<br>
            It is system-generated — please do not reply to this email.
          </p>

        </td>

        {{-- Right column --}}
        <td valign="top" style="padding:26px 30px 22px 28px;text-align:right;">

          <p style="margin:0 0 6px;color:#c8a84b;font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:.12em;">Technical Support</p>
          <p style="margin:0 0 4px;color:#ffffff;font-size:13px;font-weight:800;line-height:1.4;">
            Agenda 2063<br>Technical Support Team
          </p>
          <p style="margin:0 0 16px;color:rgba(255,255,255,0.35);font-size:10px;">platform@agenda2063.africa</p>

          {{-- Confidential badge --}}
          <table cellpadding="0" cellspacing="0" border="0" style="float:right;">
            <tr>
              <td style="background:rgba(200,168,75,0.14);border:1px solid rgba(200,168,75,0.35);border-radius:4px;padding:5px 13px;text-align:center;">
                <span style="color:#c8a84b;font-size:9px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;">CONFIDENTIAL &nbsp;&#183;&nbsp; INTERNAL USE ONLY</span>
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
            &nbsp;&#183;&nbsp; Ref: {{ $refNo }}
            &nbsp;&#183;&nbsp; {{ $d['generated_at']->format('d M Y H:i \U\T\C') }}
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
