@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row">
        <div class="col">
        <img src="{{ asset('images/campaigns/'.$campaign->cover_img) }}" class="rounded mx-auto d-block" style="max-width: 70%">
        </div>
        <div class="col m-3">
            <h1 class="text-center">
                {{ $campaign->title }}
            </h1>
            <h5 class="text-center">
                Organized by <b>{{ $campaign->user->name }}</b>
            </h5> 
            <p class="text-center">
                Open until <b>{{ date('d F Y', strtotime($campaign->deadline)) }}</b>
            </p>
            <p class="m-3 p-3 text-center">
                {{ $campaign->description }}
            </p>
        </div>
    </div>

    <div class="rounded bg-secondary bg-opacity-10 mt-3 p-5">
            <div class="d-flex justify-content-between">
                <h3>
                    Donations
                </h3>
                <a href="{{ route('campaign.donation.index', $campaign->id) }}">Show More</a>
            </div>
            <div class="text-center m-3 p-3">
                <p>
                    {{ $campaign->count_donation }} people have donated.
                </p>
                <p>
                    Rp {{ number_format($campaign->total_donation) }},- from Rp {{ number_format($campaign->target) }},-
                </p>             
            </div>   
    
            <a href="{{ route('campaign.donation.create', $campaign->id) }}" class="btn btn-primary text-center">Donate!</a>
            <div>
                @forelse($donations as $donation)
                    <div class="row mt-5">
                        <h3>
                            @if ($donation->is_anon)
                                Anonymous
                            @else
                                {{ $donation->user->name }} 
                            @endif
                            donated Rp {{ number_format($donation->nominal) }} 
                        </h3>
                        <p>
                            <b>Message: </b> {{ $donation->message }}
                        </p>
                    </div>
                    <hr>
                @empty
                    <h5 class="text-center">
                        Be the first one to donate!
                    </h5>
                @endforelse                 
            </div>

    </div>
</div>
@endsection