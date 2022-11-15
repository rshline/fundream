<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaign)
    {
        $donations = Donation::with(['user', 'campaign'])
        ->where('campaigns_id', $campaign)
        ->latest()
        ->get();

        return view('donation.index', [
            'donations' => $donations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        return view('donation.create', [
            'campaign' => $campaign
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        $anon_checked = $request->has('is_anon');

        $donation = Donation::create([
            'campaigns_id' => request('campaigns_id'),
            'users_id' => request('users_id'),
            'nominal' => request('nominal'),
            'message' => request('message'),
            'is_verified' => false,
            'is_anon' => $anon_checked,
            'donation_method' => request('donation_method'),
            'proof_img' => request('proof_img'),
        ]);

        if ($request->hasFile('proof_img')) {
            $request->file('proof_img')->move('images/donations/', $request->file('proof_img')->getClientOriginalName());
            $donation->proof_img = $request->file('proof_img')->getClientOriginalName();
            $donation->save();
        }
        
        return redirect()->route('campaign.show', $request->campaigns_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show($campaign, Donation $donation)
    {
        $donation_data = Donation::with(['user', 'campaign'])
        ->where('campaigns_id', $campaign)
        ->get()
        ->find($donation);

        return view('donation.show', [
            'donation' => $donation_data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        return view('donation.edit',[
            'donation' => $donation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update($campaign, Donation $donation)
    {
        $donation->update([
            'is_verified' => true,
        ]);

        $campaigns = Campaign::findOrFail($campaign);
        $campaigns->count_donation = $campaigns->count_donation+1;
        $campaigns->total_donation = $campaigns->total_donation+$donation->nominal;
        $campaigns->save();

        return redirect()->route('campaign.show', $campaign);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy($campaign, Donation $donation)
    {

        $donation->delete();

        return redirect()->route('campaign.show', $campaign);

    }
}
