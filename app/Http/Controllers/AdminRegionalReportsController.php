<?php

namespace App\Http\Controllers;

use App\Models\RegionalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRegionalReportsController extends Controller
{
    public function index(Request $request)
    {
        $reports = RegionalReport::latest()->get();
        return view('admin.regional-data', compact('reports'));
    }

    public function store(Request $request)
    {
        $data = $this->validateReport($request);
        if ($request->hasFile('banner')) {
            $data['banner_path'] = $request->file('banner')->store('reports/regional', 'public');
        }
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        RegionalReport::create($data);
        return back()->with('status', 'Regional report added.');
    }

    public function update(Request $request, RegionalReport $report)
    {
        $data = $this->validateReport($request);
        if ($request->hasFile('banner')) {
            if ($report->banner_path) Storage::disk('public')->delete($report->banner_path);
            $data['banner_path'] = $request->file('banner')->store('reports/regional', 'public');
        }
        $data['updated_by'] = $request->user()->id;
        $report->update($data);
        return back()->with('status', 'Regional report updated.');
    }

    public function destroy(RegionalReport $report)
    {
        if ($report->banner_path) Storage::disk('public')->delete($report->banner_path);
        $report->delete();
        return back()->with('status', 'Regional report deleted.');
    }

    protected function validateReport(Request $request): array
    {
        return $request->validate([
            'region_code' => ['required', 'string', 'max:10'],
            'region_name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'status' => ['required', 'in:draft,submitted,published'],
            'overall_score' => ['required', 'numeric', 'min:0', 'max:100'],
            'summary' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'banner' => ['nullable', 'image', 'max:20480'],
        ]);
    }
}
