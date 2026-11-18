<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('status', 'aktif')->latest()->get();

        return view('campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $donors = $campaign->donations()->latest()->take(8)->get();

        return view('campaigns.show', compact('campaign', 'donors'));
    }
}