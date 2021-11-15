@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h1>Notes Shared with you</h1>
        <a href="{{ route('note.create') }}" class="btn btn-primary my-3 mx-auto">Add a new Note</a>

        <div class="row mt-4">
            @foreach ($notes as $note)
                <div class="card col-3 mx-1" style="width: 18rem;">
                    <div class="w-100">

                        <a href="{{ route('note.edit', $note) }}" class="btn btn-warning mt-2"><i
                                class="fas fa-pen"></i></a>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-secondary">{{ $note->author->name }}</h5>
                        <h3 class="card-text text-bold my-3">
                            {{ Illuminate\Support\Str::limit($note->text, 100, '(...)') }}</h3>
                        <div class="btn btn-danger">{{ count($note->likes) }} <i class="fas fa-heart"></i>
                        </div>
                        <a href="{{ route('note.show', $note) }}" class="btn btn-primary ms-4">Read more</a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
