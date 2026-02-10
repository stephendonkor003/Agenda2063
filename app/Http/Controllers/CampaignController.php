<?php

namespace App\Http\Controllers;

use App\Models\CampaignSignup;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:campaign_signups,email',
            'country'    => 'required|string|max:255',
            'interest'   => 'nullable|string|max:255',
            'newsletter' => 'nullable',
            'terms'      => 'accepted',
        ]);

        CampaignSignup::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'country'    => $validated['country'],
            'interest'   => $validated['interest'] ?? null,
            'newsletter' => $request->has('newsletter'),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for joining the Agenda 2063 Campaign!',
            ]);
        }

        return back()->with('campaign_success', 'Thank you for joining the Agenda 2063 Campaign!');
    }
}
