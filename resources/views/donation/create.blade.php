@extends('layouts.app')

@section('content')
<div class="container">
    <div class="m-3 p-3">
        <h2>Donate</h2>
    </div>

    @if ($errors->any())
        <div class="m-3 p-3" role="alert">
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        </div>
    @endif

    <form action="{{ route('campaign.donation.store', $campaign->id) }}" method="post" enctype="multipart/form-data" class="m-3 p-3">
    @csrf
        
        <input type="hidden" name="campaigns_id" value="{{$campaign->id}}">
        <input type="hidden" name="users_id" value="{{Auth::user()->id}}">

        <div class="input-group mb-3">
            <span class="input-group-text">Nominal</span>
            <span class="input-group-text">Rp</span>
            <input type="number" name="nominal" class="form-control" aria-label="Nominal" id="nominal" value="{{ old('nominal') }}">
        </div>
        <div class="form-group mb-3">
            <label for="message">Message</label>
            <input type="text" name="message" class="form-control" id="message" value="{{ old('message') }}">
        </div>
        <div class="row mb-3">
            <div class="col">
                <select class="form-select mb-3" aria-label="Payment method" name="donation_method">
                    <option value="transfer" selected>Transfer</option>
                    <option value="paypal">PayPal</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
            </div>
            <div class="col">
                <input class="form-control" type="file" accept="image/*" id="formFile" name="proof_img">
            </div>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="is_anon">
            <label class="form-check-label" for="flexCheckDefault">
                Show as Anonymous
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    

</div>
@endsection