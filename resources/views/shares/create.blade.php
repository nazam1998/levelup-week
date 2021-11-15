@extends('layouts.app')

@section('title', 'Add Note')

@section('content')

    <h1 class="text-center">Add a new note</h1>

    <div class="container">
        <form action={{ route('share.store', $note) }} method="post">
            @csrf
            <div class="mb-3">
                @error('text')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <label for="text" class="form-label">Your note</label>
                <p id="note">{{ $note->text }}</p>
            </div>
            <div class="row my-4">
                <h4 class="col-3">Users</h4>
            </div>
            @if (Session::has('msg'))
                <p class="text-danger">{{ Session('msg') }}</p>
            @endif
            @error('users')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="container row my-4">
                @foreach ($users as $user)
                    <div class="mb-3 form-check col-1">
                        @if($note->shared->contains($user->id))

                        <input checked type="checkbox" class="form-check-input" name="users[]" value="{{ $user->id }}" id="users">
                        @else
                        <input type="checkbox" class="form-check-input" name="users[]" value="{{ $user->id }}" id="users">
                        @endif
                        <label class="form-check-label" for="exampleCheck{{ $user->id }}">{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Share</button>
        </form>
    </div>
@endsection
