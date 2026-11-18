<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('campaign')->latest()->get();

        return view('donations.index', compact('donations'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'donor_name'  => 'required|string|max:100',
            'donor_email' => 'required|email|max:100',
            'amount'      => 'required|integer|min:10000',
            'message'     => 'nullable|string|max:300',
        ], [
            'amount.min' => 'Nominal donasi minimal Rp 10.000.',
        ]);

        DB::transaction(function () use ($campaign, $data) {
            $campaign->donations()->create($data);
            $campaign->increment('dana_terkumpul', $data['amount']);
        });

        return redirect()->route('donations.index')
            ->with('success', 'Terima kasih, donasi Anda berhasil dicatat.');
    }
}