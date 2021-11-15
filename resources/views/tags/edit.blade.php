@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')

    <h1 class="text-center">Add a new tag</h1>

    <div class="container">
        <form action="{{ route('tag.update', $tag) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="text" class="form-label">Tag Name</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input class="form-control" id="text" name="name" aria-describedby="text-note" value={{ $tag->name }}>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>
@endsection
