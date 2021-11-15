@extends('layouts.app')

@section('title', 'Add Tag')

@section('content')

    <h1 class="text-center">Add a new tag</h1>

    <div class="container">
        <form action={{ route('tag.store') }} method="POST">
            @csrf
            <div class="mb-3">
                <label for="text" class="form-label">Tag Name</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input class="form-control w-25" id="text" name="name" aria-describedby="text-note">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>
@endsection
