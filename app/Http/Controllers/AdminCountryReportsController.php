<?php

namespace App\Http\Controllers;

use App\Models\CountryReport;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCountryReportsController extends Controller
{
    public function index(Request $request)
    {
        $reports = CountryReport::latest()->get();
        return view('admin.country-reports', compact('reports'));
    }

    public function store(Request $request)
    {
        $data = $this->validateReport($request);
        if ($request->hasFile('banner')) {
            $data['banner_path'] = $request->file('banner')->store('reports/country', 'public');
        }
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        CountryReport::create($data);
        return back()->with('status', 'Country report added.');
    }

    public function update(Request $request, CountryReport $report)
    {
        $data = $this->validateReport($request);
        if ($request->hasFile('banner')) {
            if ($report->banner_path) Storage::disk('public')->delete($report->banner_path);
            $data['banner_path'] = $request->file('banner')->store('reports/country', 'public');
        }
        $data['updated_by'] = $request->user()->id;
        $report->update($data);
        return back()->with('status', 'Country report updated.');
    }

    public function destroy(CountryReport $report)
    {
        if ($report->banner_path) Storage::disk('public')->delete($report->banner_path);
        $report->delete();
        return back()->with('status', 'Country report deleted.');
    }

    protected function validateReport(Request $request): array
    {
        return $request->validate([
            'country_code' => ['required', 'string', 'max:3'],
            'country_name' => ['required', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'status' => ['required', 'in:draft,submitted,published'],
            'overall_score' => ['required', 'numeric', 'min:0', 'max:100'],
            'summary' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'banner' => ['nullable', 'image', 'max:20480'],
        ]);
    }
}
