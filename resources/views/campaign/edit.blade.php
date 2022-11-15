@extends('layouts.app')

@section('content')
<div class="container">
    <div class="m-3 p-3">
        <h2>Edit Campaign &raquo; {{ $campaign->title }} </h2>
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

    <form action="{{ route('campaign.update', $campaign->id) }}" method="post" enctype="multipart/form-data" class="m-3 p-3">
    @csrf
    @method('put')

        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') ?? $campaign->title }}">
        </div>
        <div class="form-group mb-3">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" class="form-control" id="deadline" value="{{ old('deadline') ?? $campaign->deadline }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Target</span>
            <span class="input-group-text">Rp</span>
            <input type="number" name="target" class="form-control" aria-label="Target" id="target" value="{{ old('target') ?? $campaign->target }}">
        </div>
        <div class="input-group mb-3">
            <input type="file" name="cover_img" class="form-control" id="cover_img" accept="image/*" value="{{ old('cover_img') ?? $campaign->cover_img }}">
            <label class="input-group-text" for="img_url">Upload</label>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') ?? $campaign->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    

</div>
@endsection