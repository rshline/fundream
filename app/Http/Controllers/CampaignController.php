<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::paginate(12);

       return view('campaign.index', [
            'campaigns' => $campaigns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $campaign = Campaign::create([
            'users_id' => Auth::user()->id,
            'title' => request('title'),
            'description' => request('description'),
            'target' => request('target'),
            'deadline' => request('deadline'),
            'cover_img' => request('cover_img'),
        ]);

        if ($request->hasFile('cover_img')) {
            $request->file('cover_img')->move('images/campaigns/', $request->file('cover_img')->getClientOriginalName());
            $campaign->cover_img = $request->file('cover_img')->getClientOriginalName();
            $campaign->save();
        }

         return redirect()->route('campaign.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaign_data = Campaign::with('user')
            ->find($campaign)
            ->first();

        $donations = Donation::with('user')
            ->where('campaigns_id', $campaign->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('campaign.show', [
            'campaign' => $campaign_data,
            'donations' => $donations
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaign.edit',[
            'campaign' => $campaign
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {  
        if ($request->hasFile('cover_img')) {
            if($campaign->cover_img != ''  && $campaign->cover_img != null){
                $file_old = 'images/campaigns/'.$campaign->cover_img;
                unlink($file_old);
            }

            $campaign->update([
                'title' => request('title'),
                'description' => request('description'),
                'target' => request('target'),
                'deadline' => request('deadline'),
                'cover_img' => request('cover_img')
            ]);

            $request->file('cover_img')->move('images/campaigns/', $request->file('cover_img')->getClientOriginalName());
            $campaign->cover_img = $request->file('cover_img')->getClientOriginalName();
            $campaign->save();

        } else {
            $campaign->update([
                'title' => request('title'),
                'description' => request('description'),
                'target' => request('target'),
                'deadline' => request('deadline')
            ]);
        }

        return redirect()->route('campaign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaign.index');
    }
}
