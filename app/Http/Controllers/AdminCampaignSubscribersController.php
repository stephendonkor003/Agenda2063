<?php

namespace App\Http\Controllers;

use App\Models\CampaignSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendCampaignBroadcast;

class AdminCampaignSubscribersController extends Controller
{
    public function index()
    {
        $total = CampaignSignup::count();
        $newsletterPct = $total ? round((CampaignSignup::where('newsletter', true)->count() / $total) * 100, 1) : 0;

        $byCountry = CampaignSignup::select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $byInterest = CampaignSignup::select('interest', DB::raw('count(*) as total'))
            ->groupBy('interest')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $recent = CampaignSignup::latest()->limit(25)->get();

        return view('admin.campaign-subscribers', compact('total', 'newsletterPct', 'byCountry', 'byInterest', 'recent'));
    }

    public function broadcast(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required','string','max:255'],
            'preview' => ['nullable','string','max:255'],
            'body_html' => ['required','string'],
            'footer' => ['nullable','string','max:500'],
            'only_newsletter' => ['sometimes','boolean'],
        ]);

        $query = CampaignSignup::query();
        if ($request->boolean('only_newsletter')) {
            $query->where('newsletter', true);
        }

        $total = $query->count();
        if ($total === 0) {
            return back()->withErrors(['broadcast' => 'No subscribers match this filter.']);
        }

        $query->chunkById(500, function($chunk) use ($data) {
            SendCampaignBroadcast::dispatch($chunk->pluck('email')->all(), $data)
                ->onQueue('mail');
        });

        return back()->with('status', "Broadcast queued to {$total} subscribers.");
    }
}
