@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="d-flex justify-content-between m-3 p-3">
        <h2>Donation details</h2>
    </div> 
    <hr>
    <div class="row">
        <div class="col flex">
            <img src="{{ asset('images/donations/'.$donation->proof_img) }}" style="max-width: 100%">
            <p class="text-center">Donation proof</p>
        </div>
        <div class="col flex rounded bg-secondary bg-opacity-10 mx-3 p-3">
            <h3>Info</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{$donation->user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nominal</th>
                        <td>Rp {{$donation->nominal}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Message</th>
                        <td>{{$donation->message}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td>{{$donation->created_at}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                @if (((Auth::user()->roles == 'ADMIN') 
                        OR (Auth::user()->id == $donation->campaign->users_id)) 
                    AND ($donation->is_verified==false)
                )
                <form method="POST" action="{{ route('campaign.donation.update', ['campaign'=>$donation->campaigns_id, 'donation'=>$donation->id]) }}">
                @csrf
                @method('put')

                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-primary m-1" value="Verify">
                    </div>
                </form>
                <form method="POST" action="{{ route('campaign.donation.destroy', ['campaign'=>$donation->campaigns_id, 'donation'=>$donation->id]) }}">
                @csrf
                @method('delete')

                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-danger m-1" value="Delete">
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection