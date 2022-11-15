@extends('layouts.app')

@section('title')
    Campaigns
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('campaign.show', $donations[0]->campaigns_id) }}">Back</a>
        <h2>Donation</h2>
    </div>
    <hr>

    <div class="rounded bg-secondary bg-opacity-10 mt-3 p-5">
    @forelse($donations as $donation)
    <div class="row mt-5">
        <div class="col">
            <h3>
                @if ($donation->is_anon)
                    Anonymous
                @else
                    {{ $donation->user->name }} 
                @endif
                donated Rp {{ $donation->nominal }} 
            </h3>
            <p>
                <b>Message: </b> {{ $donation->message }}
            </p>
        </div>
        <div class="col d-flex justify-content-end">
            <div>
                @if ((Auth::user()->id == $donation->user->id) OR (Auth::user()->id == $donation->campaign->users_id))
                <a href="{{ route('campaign.donation.show', ['campaign'=>$donation->campaigns_id, 'donation'=>$donation->id]) }}" class="btn btn-outline-primary m-1">Show</a>                
                @elseif ($donation->is_verified==false)
                <p>Not verified</p>
                @endif            
            </div>

        </div>
    </div>
    <hr>
    @empty

    @endforelse
    </div>

</div>
@endsection