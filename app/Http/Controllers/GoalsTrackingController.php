<?php

namespace App\Http\Controllers;

use App\Models\ExternalDataSource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GoalsTrackingController extends Controller
{
    public function index()
    {
        $sources = ExternalDataSource::orderBy('name')->get();
        // placeholder aggregated stats
        $overall = [
            'progress' => 60,
            'on_track' => 12,
            'at_risk' => 5,
            'off_track' => 3,
        ];
        return view('admin.goals-tracking', compact('sources', 'overall'));
    }

    public function storeSource(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'provider' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:rest,graphql,sftp,manual'],
            'base_url' => ['nullable', 'url'],
            'auth_type' => ['required', 'in:api_key,bearer,basic,none'],
            'api_key' => ['nullable', 'string', 'max:512'],
            'auth_header' => ['nullable', 'string', 'max:255'],
            'sync_frequency' => ['required', 'in:hourly,daily,weekly,manual'],
            'notes' => ['nullable', 'string'],
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['status'] = 'inactive';
        ExternalDataSource::create($data);
        return back()->with('status', 'Data source added.');
    }

    public function updateSource(Request $request, ExternalDataSource $source)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'provider' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:rest,graphql,sftp,manual'],
            'base_url' => ['nullable', 'url'],
            'auth_type' => ['required', 'in:api_key,bearer,basic,none'],
            'api_key' => ['nullable', 'string', 'max:512'],
            'auth_header' => ['nullable', 'string', 'max:255'],
            'sync_frequency' => ['required', 'in:hourly,daily,weekly,manual'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive,error'],
        ]);
        $source->update($data);
        return back()->with('status', 'Data source updated.');
    }
}
