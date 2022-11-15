@extends('layouts.app')

@section('title')
    Campaigns
@endsection

@section('content')
<div class="container">
    <h2>Campaigns</h2>
    <hr>
    <div class="d-flex justify-content-end">
        <a href="{{ route('campaign.create') }}" class="btn btn-primary">
            + Create Campaign 
        </a>        
    </div>

    <div class="d-flex m-3 p-3">
            @forelse($campaigns as $campaign)
            <div class="flex-md-fill card m-3" style="width: 18rem;">
                <img src="{{ asset('images/campaigns/'.$campaign->cover_img) }}" class="card-img-top" style="max-width: 100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $campaign->title }}</h5>
                    <p class="card-text">Rp {{ number_format($campaign->total_donation) }} from Rp {{ number_format($campaign->target) }}.</p>
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            @if (Auth::user()->id == $campaign->users_id)
                            <a href="{{ route('campaign.edit', $campaign->id) }}" class="btn btn-outline-primary m-1">Edit</a>
                            <form method="POST" action="{{ route('campaign.destroy', $campaign->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-danger m-1" value="Delete">
                                </div>
                            </form>
                            @endif
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-primary">Donate!</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="d-flex justify-content-center">
                <h4>There is no campaign yet.</h4>
            </div>    
            @endforelse 
    </div>
    <div>
        {{ $campaigns->links() }}
    </div>

</div>
@endsection