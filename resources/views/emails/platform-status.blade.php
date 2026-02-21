@php
    use Illuminate\Support\Number;

    /* ── helpers ─────────────────────────────────────────── */
    function fmtBytes(int $bytes): string {
        if ($bytes <= 0) return '—';
        $units = ['B','KB','MB','GB','TB'];
        $i = (int) floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 1) . ' ' . $units[$i];
    }

    function fmtDuration(int $secs): string {
        if ($secs < 60)  return "{$secs}s";
        if ($secs < 3600) return floor($secs/60).'m '.($secs%60).'s';
        return floor($secs/3600).'h '.floor(($secs%3600)/60).'m';
    }

    function statusBadge(bool $ok, string $okLabel = 'OK', string $failLabel = 'ALERT'): string {
        $color = $ok ? '#16a34a' : '#dc2626';
        $label = $ok ? $okLabel : $failLabel;
        return "<span style=\"background:{$color};color:#fff;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;letter-spacing:.05em;\">{$label}</span>";
    }

    $diskOk     = $d['server']['disk_used_pct'] < 85;
    $failedOk   = $d['queue']['failed_jobs'] === 0;
    $queueOk    = $d['queue']['pending_jobs'] < 200;
    $overallOk  = $diskOk && $failedOk && $queueOk;
    $statusColor = $overallOk ? '#16a34a' : '#dc2626';
    $statusLabel = $overallOk ? 'ALL SYSTEMS OPERATIONAL' : 'ATTENTION REQUIRED';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agenda 2063 – Platform Status Report</title>
</head>
<body style="margin:0;padding:0;background:#eef0f4;font-family:'Segoe UI',Arial,Helvetica,sans-serif;">

<!-- ═══════════════════════════════════════════════════════════ WRAPPER -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#eef0f4;padding:30px 0;">
<tr><td align="center">
<table width="660" cellpadding="0" cellspacing="0" border="0" style="max-width:660px;width:100%;">

    <!-- ─────────────────────────────────────────────────────── HEADER -->
    <tr>
      <td style="background:linear-gradient(135deg,#0a1628 0%,#1a2e50 50%,#0e2044 100%);border-radius:14px 14px 0 0;padding:0;overflow:hidden;">
        <!-- Top accent bar -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="background:linear-gradient(90deg,#c8a84b 0%,#f0d070 40%,#c8a84b 100%);height:5px;font-size:1px;">&nbsp;</td>
          </tr>
        </table>
        <!-- Header content -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="padding:32px 36px 28px;">
              <!-- Badge row -->
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="background:rgba(200,168,75,0.18);border:1px solid rgba(200,168,75,0.5);border-radius:20px;padding:4px 14px;">
                    <span style="color:#f0d070;font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;">Platform Intelligence Report</span>
                  </td>
                  <td style="padding-left:12px;">
                    <span style="color:rgba(255,255,255,0.45);font-size:11px;">Every 5 Hours</span>
                  </td>
                </tr>
              </table>

              <!-- Title -->
              <h1 style="margin:18px 0 6px;color:#ffffff;font-size:28px;font-weight:800;letter-spacing:-0.3px;line-height:1.15;">
                Agenda 2063<br>
                <span style="color:#c8a84b;">Platform Status Report</span>
              </h1>
              <p style="margin:0 0 20px;color:rgba(255,255,255,0.6);font-size:13px;">
                Generated: {{ $d['generated_at']->format('l, d F Y · H:i \U\T\C') }}
                &nbsp;·&nbsp; Reporting window: last <strong style="color:#f0d070;">{{ $d['period_hours'] }} hours</strong>
              </p>

              <!-- Overall status pill -->
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="background:{{ $statusColor }};border-radius:30px;padding:8px 22px;">
                    <span style="color:#fff;font-size:12px;font-weight:800;letter-spacing:.1em;">
                      @if($overallOk) ✔ @else ⚠ @endif &nbsp;{{ $statusLabel }}
                    </span>
                  </td>
                </tr>
              </table>
            </td>

            <!-- Right: AU emblem area -->
            <td width="130" valign="middle" style="padding:28px 28px 28px 0;text-align:center;">
              <div style="width:90px;height:90px;border-radius:50%;background:rgba(200,168,75,0.15);border:2px solid rgba(200,168,75,0.35);margin:0 auto;display:flex;align-items:center;justify-content:center;">
                <div style="text-align:center;color:#c8a84b;font-size:10px;font-weight:700;letter-spacing:.05em;line-height:1.4;padding:10px;">
                  <div style="font-size:28px;margin-bottom:4px;">🌍</div>
                  AU<br>2063
                </div>
              </div>
              <div style="color:rgba(255,255,255,0.35);font-size:9px;margin-top:8px;letter-spacing:.05em;">AGENDA 2063</div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- ──────────────────────────────────────────── SUMMARY KPI CARDS -->
    <tr>
      <td style="background:#1a2e50;padding:0 36px 0;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid rgba(255,255,255,0.08);">
          <tr>
            @php $kpis = [
              ['label'=>'Sessions (5h)',    'value'=>number_format($d['analytics']['sessions_period']),  'sub'=>'of '.number_format($d['analytics']['all_time_sessions']).' total',   'icon'=>'👥', 'color'=>'#38bdf8'],
              ['label'=>'Page Views (5h)',  'value'=>number_format($d['analytics']['pageviews_period']), 'sub'=>'of '.number_format($d['analytics']['all_time_pageviews']).' total',  'icon'=>'📄', 'color'=>'#34d399'],
              ['label'=>'Avg. Session',     'value'=>fmtDuration($d['analytics']['avg_session_seconds']),'sub'=>'time on platform',                                                 'icon'=>'⏱',  'color'=>'#f59e0b'],
              ['label'=>'New Signups (5h)', 'value'=>number_format($d['subscribers']['new_period']),    'sub'=>number_format($d['subscribers']['total']).' total subscribers',       'icon'=>'✉', 'color'=>'#a78bfa'],
            ]; @endphp
            @foreach($kpis as $kpi)
            <td width="25%" style="padding:18px 10px 18px {{ $loop->first ? '0' : '8px' }};text-align:center;border-right:{{ $loop->last ? 'none' : '1px solid rgba(255,255,255,0.07)' }};">
              <div style="font-size:22px;margin-bottom:4px;">{{ $kpi['icon'] }}</div>
              <div style="color:{{ $kpi['color'] }};font-size:22px;font-weight:800;line-height:1;">{{ $kpi['value'] }}</div>
              <div style="color:#fff;font-size:11px;font-weight:600;margin:4px 0 2px;text-transform:uppercase;letter-spacing:.05em;">{{ $kpi['label'] }}</div>
              <div style="color:rgba(255,255,255,0.4);font-size:10px;">{{ $kpi['sub'] }}</div>
            </td>
            @endforeach
          </tr>
        </table>
      </td>
    </tr>

    <!-- Main body card -->
    <tr>
      <td style="background:#ffffff;padding:32px 36px;border-radius:0 0 14px 14px;">

        <!-- ───────────────────────────────── SECTION: TRAFFIC ANALYTICS -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
          <tr>
            <td style="border-left:4px solid #0369a1;padding-left:12px;margin-bottom:16px;">
              <h2 style="margin:0 0 2px;color:#0f172a;font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">📊 Traffic Analytics</h2>
              <p style="margin:0;color:#64748b;font-size:12px;">Activity breakdown for the last {{ $d['period_hours'] }} hours</p>
            </td>
          </tr>
          <tr><td style="padding-top:14px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
              <tr style="background:#e2e8f0;">
                <th style="text-align:left;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Event Type</th>
                <th style="text-align:right;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Count (5h)</th>
                <th style="text-align:right;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Status</th>
              </tr>
              @php $events = [
                ['label'=>'Page Views',          'count'=>$d['analytics']['pageviews_period'],  'icon'=>'📄'],
                ['label'=>'Document Downloads',  'count'=>$d['analytics']['downloads'],         'icon'=>'⬇️'],
                ['label'=>'Campaign Signups',    'count'=>$d['analytics']['subscriptions'],     'icon'=>'✉️'],
                ['label'=>'Quiz Interactions',   'count'=>$d['analytics']['quiz_interactions'], 'icon'=>'🎯'],
                ['label'=>'Active Sessions',     'count'=>$d['analytics']['sessions_period'],   'icon'=>'👥'],
              ]; @endphp
              @foreach($events as $ev)
              <tr style="border-top:1px solid #e2e8f0;background:{{ $loop->odd ? '#f8fafc' : '#ffffff' }};">
                <td style="padding:10px 14px;color:#1e293b;font-size:13px;">{{ $ev['icon'] }} {{ $ev['label'] }}</td>
                <td style="padding:10px 14px;text-align:right;color:#0f172a;font-weight:700;font-size:14px;">{{ number_format($ev['count']) }}</td>
                <td style="padding:10px 14px;text-align:right;">
                  @if($ev['count'] > 0)
                    <span style="background:#dcfce7;color:#16a34a;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">Active</span>
                  @else
                    <span style="background:#f1f5f9;color:#94a3b8;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">None</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </table>
          </td></tr>
        </table>

        <!-- ───────────────────────────── SECTION: TOP COUNTRIES -->
        @if($d['top_countries']->isNotEmpty())
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
          <tr>
            <td style="border-left:4px solid #0891b2;padding-left:12px;margin-bottom:16px;">
              <h2 style="margin:0 0 2px;color:#0f172a;font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">🌍 Access by Country</h2>
              <p style="margin:0;color:#64748b;font-size:12px;">Top countries accessing the platform in the last {{ $d['period_hours'] }} hours</p>
            </td>
          </tr>
          <tr><td style="padding-top:14px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
              <tr style="background:#e2e8f0;">
                <th style="text-align:left;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">#</th>
                <th style="text-align:left;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Country</th>
                <th style="text-align:right;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Sessions</th>
                <th style="text-align:right;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Share</th>
              </tr>
              @php $totalCtSessions = $d['top_countries']->sum('visits'); @endphp
              @foreach($d['top_countries'] as $i => $ct)
              <tr style="border-top:1px solid #e2e8f0;background:{{ ($i % 2 === 0) ? '#f8fafc' : '#ffffff' }};">
                <td style="padding:10px 14px;color:#94a3b8;font-size:12px;font-weight:700;">{{ $i + 1 }}</td>
                <td style="padding:10px 14px;color:#1e293b;font-size:13px;font-weight:600;">
                  {{ strtoupper($ct->country ?? 'Unknown') }}
                </td>
                <td style="padding:10px 14px;text-align:right;color:#0f172a;font-weight:700;font-size:14px;">{{ number_format($ct->visits) }}</td>
                <td style="padding:10px 14px;text-align:right;">
                  @php $pct = $totalCtSessions > 0 ? round(($ct->visits / $totalCtSessions) * 100, 1) : 0; @endphp
                  <div style="display:inline-block;min-width:60px;">
                    <div style="background:#e2e8f0;border-radius:4px;height:6px;margin-bottom:3px;">
                      <div style="background:#0891b2;border-radius:4px;height:6px;width:{{ min(100,$pct) }}%;"></div>
                    </div>
                    <span style="color:#475569;font-size:11px;">{{ $pct }}%</span>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </td></tr>
        </table>
        @endif

        <!-- ───────────────────────────── SECTION: TOP PAGES -->
        @if($d['top_pages']->isNotEmpty())
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
          <tr>
            <td style="border-left:4px solid #7c3aed;padding-left:12px;">
              <h2 style="margin:0 0 2px;color:#0f172a;font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">📑 Most Visited Pages</h2>
              <p style="margin:0;color:#64748b;font-size:12px;">Highest-traffic content in the last {{ $d['period_hours'] }} hours</p>
            </td>
          </tr>
          <tr><td style="padding-top:14px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
              <tr style="background:#e2e8f0;">
                <th style="text-align:left;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Page Path</th>
                <th style="text-align:right;padding:10px 14px;color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Views</th>
              </tr>
              @foreach($d['top_pages'] as $i => $pg)
              <tr style="border-top:1px solid #e2e8f0;background:{{ ($i % 2 === 0) ? '#f8fafc' : '#ffffff' }};">
                <td style="padding:10px 14px;color:#1e293b;font-size:13px;font-family:monospace;">
                  /{{ ltrim($pg->path, '/') ?: '(home)' }}
                </td>
                <td style="padding:10px 14px;text-align:right;color:#7c3aed;font-weight:700;font-size:14px;">{{ number_format($pg->views) }}</td>
              </tr>
              @endforeach
            </table>
          </td></tr>
        </table>
        @endif

        <!-- ───────────────────────── SECTION: SERVER HEALTH -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
          <tr>
            <td style="border-left:4px solid {{ $diskOk ? '#16a34a' : '#dc2626' }};padding-left:12px;">
              <h2 style="margin:0 0 2px;color:#0f172a;font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">
                🖥️ Server Health
                &nbsp;{!! statusBadge($diskOk) !!}
              </h2>
              <p style="margin:0;color:#64748b;font-size:12px;">Infrastructure and runtime metrics</p>
            </td>
          </tr>
          <tr><td style="padding-top:14px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <!-- Disk usage card -->
                <td width="48%" valign="top" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-right:4%;">
                  <div style="color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:10px;">💾 Disk Usage</div>
                  @if($d['server']['disk_total'] > 0)
                    <div style="background:#e2e8f0;border-radius:6px;height:10px;margin-bottom:8px;">
                      <div style="background:{{ $diskOk ? '#16a34a' : '#dc2626' }};border-radius:6px;height:10px;width:{{ $d['server']['disk_used_pct'] }}%;"></div>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                      <span style="color:#0f172a;font-size:20px;font-weight:800;">{{ $d['server']['disk_used_pct'] }}%</span>
                      <span style="color:#64748b;font-size:12px;margin-top:6px;">used</span>
                    </div>
                    <div style="color:#94a3b8;font-size:11px;margin-top:4px;">
                      {{ fmtBytes($d['server']['disk_total'] - $d['server']['disk_free']) }} used
                      of {{ fmtBytes($d['server']['disk_total']) }}
                      &nbsp;·&nbsp; {{ fmtBytes($d['server']['disk_free']) }} free
                    </div>
                  @else
                    <div style="color:#94a3b8;font-size:12px;">Disk info unavailable</div>
                  @endif
                </td>
                <td width="4%">&nbsp;</td>
                <!-- Runtime info card -->
                <td width="48%" valign="top" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;">
                  <div style="color:#475569;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:10px;">⚙️ Runtime Info</div>
                  @php $runtime = [
                    ['k'=>'PHP Version',     'v'=>$d['server']['php_version']],
                    ['k'=>'Memory Limit',    'v'=>$d['server']['memory_limit']],
                    ['k'=>'Environment',     'v'=>strtoupper($d['server']['app_env'])],
                    ['k'=>'App URL',         'v'=>$d['server']['app_url']],
                    ['k'=>'Platform Users',  'v'=>number_format($d['users']['total'])],
                  ]; @endphp
                  @foreach($runtime as $rt)
                  <div style="display:flex;justify-content:space-between;border-bottom:1px solid #e2e8f0;padding:5px 0;{{ $loop->last ? 'border-bottom:none;' : '' }}">
                    <span style="color:#64748b;font-size:12px;">{{ $rt['k'] }}</span>
                    <span style="color:#0f172a;font-size:12px;font-weight:600;">{{ $rt['v'] }}</span>
                  </div>
                  @endforeach
                </td>
              </tr>
            </table>
          </td></tr>
        </table>

        <!-- ─────────────────────────── SECTION: QUEUE & SECURITY -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
          <tr>
            <td style="border-left:4px solid {{ $failedOk ? '#16a34a' : '#dc2626' }};padding-left:12px;">
              <h2 style="margin:0 0 2px;color:#0f172a;font-size:15px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;">
                🔒 Security & Queue Status
                &nbsp;{!! statusBadge($failedOk && $queueOk) !!}
              </h2>
              <p style="margin:0;color:#64748b;font-size:12px;">Job queue health and security monitoring</p>
            </td>
          </tr>
          <tr><td style="padding-top:14px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
              @php $qstats = [
                ['label'=>'Pending Jobs in Queue', 'value'=>$d['queue']['pending_jobs'], 'ok'=>$queueOk,  'icon'=>'⏳'],
                ['label'=>'Failed Jobs Total',     'value'=>$d['queue']['failed_jobs'],  'ok'=>$failedOk, 'icon'=>'⚠️'],
                ['label'=>'Active Admin Users',    'value'=>$d['users']['active_period'],'ok'=>true,      'icon'=>'👤'],
              ]; @endphp
              @foreach($qstats as $qs)
              <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:12px 14px;color:#1e293b;font-size:13px;">{{ $qs['icon'] }} {{ $qs['label'] }}</td>
                <td style="padding:12px 14px;text-align:center;color:#0f172a;font-weight:800;font-size:15px;">{{ number_format($qs['value']) }}</td>
                <td style="padding:12px 14px;text-align:right;">{!! statusBadge($qs['ok']) !!}</td>
              </tr>
              @endforeach
            </table>

            @if($d['queue']['recent_failed']->isNotEmpty())
            <div style="margin-top:14px;background:#fff8f1;border:1px solid #fed7aa;border-radius:10px;padding:16px;">
              <div style="color:#c2410c;font-size:12px;font-weight:700;margin-bottom:10px;text-transform:uppercase;letter-spacing:.05em;">⚠️ Recent Failed Jobs</div>
              @foreach($d['queue']['recent_failed'] as $fj)
              <div style="background:#ffffff;border:1px solid #fed7aa;border-radius:6px;padding:10px 12px;margin-bottom:8px;{{ $loop->last ? 'margin-bottom:0;' : '' }}">
                <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                  <span style="color:#9a3412;font-size:12px;font-weight:700;">{{ $fj['job'] }}</span>
                  <span style="color:#94a3b8;font-size:11px;">Queue: {{ $fj['queue'] }}</span>
                </div>
                <div style="color:#c2410c;font-size:11px;font-family:monospace;word-break:break-word;">{{ $fj['exception'] }}</div>
                <div style="color:#94a3b8;font-size:10px;margin-top:4px;">Failed at: {{ $fj['failed_at'] }}</div>
              </div>
              @endforeach
            </div>
            @else
            <div style="margin-top:14px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:14px;text-align:center;">
              <span style="color:#16a34a;font-size:13px;font-weight:600;">✔ No failed jobs — queue is healthy</span>
            </div>
            @endif
          </td></tr>
        </table>

        <!-- ─────────────────────────── DIVIDER -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:4px 0 28px;">
          <tr><td style="border-top:2px solid #f1f5f9;">&nbsp;</td></tr>
        </table>

        <!-- ──────────────────────────── NOTE BOX -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
          <tr>
            <td style="background:#f0f9ff;border-left:4px solid #0284c7;border-radius:0 8px 8px 0;padding:14px 16px;">
              <p style="margin:0;color:#0369a1;font-size:12px;line-height:1.6;">
                <strong>📌 Note:</strong> This is an automated report generated every 5 hours.
                Analytics data reflects visitor activity tracked via the platform's built-in
                analytics middleware. For detailed logs, access the Admin Dashboard directly.
                If you see security alerts, please investigate immediately.
              </p>
            </td>
          </tr>
        </table>

      </td><!-- /main body -->
    </tr>

    <!-- ─────────────────────────────────────────────────────── FOOTER -->
    <tr>
      <td style="background:#0a1628;border-radius:0 0 14px 14px;overflow:hidden;">
        <!-- Gold accent -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr><td style="background:linear-gradient(90deg,#c8a84b 0%,#f0d070 40%,#c8a84b 100%);height:3px;font-size:1px;">&nbsp;</td></tr>
        </table>

        <!-- Footer content -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <!-- Left: Organisation names -->
            <td valign="top" style="padding:24px 28px 20px;">
              <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:14px;">
                <tr>
                  <td style="background:rgba(200,168,75,0.15);border:1px solid rgba(200,168,75,0.3);border-radius:6px;padding:4px 12px;margin-right:8px;">
                    <span style="color:#f0d070;font-size:10px;font-weight:800;letter-spacing:.08em;">ICD</span>
                  </td>
                  <td width="8">&nbsp;</td>
                  <td style="background:rgba(200,168,75,0.15);border:1px solid rgba(200,168,75,0.3);border-radius:6px;padding:4px 12px;">
                    <span style="color:#f0d070;font-size:10px;font-weight:800;letter-spacing:.08em;">AUDA-NEPAD</span>
                  </td>
                </tr>
              </table>

              <div style="color:#ffffff;font-size:12px;font-weight:700;margin-bottom:3px;">
                Infrastructure &amp; Continental Digitisation (ICD)
              </div>
              <div style="color:rgba(255,255,255,0.6);font-size:11px;margin-bottom:10px;">
                African Union Development Agency — NEPAD (AUDA-NEPAD)
              </div>

              <div style="border-top:1px solid rgba(255,255,255,0.1);padding-top:10px;color:rgba(255,255,255,0.45);font-size:10px;line-height:1.6;">
                This report is sent automatically to all registered platform administrators.<br>
                Do not reply to this email — it is system-generated.
              </div>
            </td>

            <!-- Right: Support team -->
            <td valign="top" style="padding:24px 28px 20px;text-align:right;border-left:1px solid rgba(255,255,255,0.08);">
              <div style="color:#c8a84b;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;">Supported by</div>
              <div style="color:#ffffff;font-size:13px;font-weight:700;line-height:1.4;">
                Agenda 2063<br>Technical Support Team
              </div>
              <div style="color:rgba(255,255,255,0.4);font-size:10px;margin-top:6px;">
                platform@agenda2063.africa
              </div>
              <div style="margin-top:14px;">
                <span style="background:rgba(200,168,75,0.2);border:1px solid rgba(200,168,75,0.4);border-radius:20px;padding:4px 12px;color:#f0d070;font-size:10px;font-weight:700;letter-spacing:.05em;">
                  🔐 CONFIDENTIAL — INTERNAL USE ONLY
                </span>
              </div>
            </td>
          </tr>
        </table>

        <!-- Bottom bar -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="background:#060e1e;padding:10px 28px;text-align:center;">
              <span style="color:rgba(255,255,255,0.25);font-size:10px;">
                © {{ date('Y') }} African Union Commission · Agenda 2063 Platform ·
                Report generated: {{ $d['generated_at']->format('d M Y H:i \U\T\C') }}
              </span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

</table><!-- /660px wrapper -->
</td></tr>
</table><!-- /outer table -->

</body>
</html>
