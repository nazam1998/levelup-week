@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h1>My Notes</h1>
        <a href="{{ route('note.create') }}" class="btn btn-primary my-3 mx-auto">Add a new Note</a>

        <div class="row mt-4">
            @foreach ($notes as $note)
                <div class="card col-6 mx-1">
                    <div class="w-100 row text-center justify-content-around">

                        <a href="{{ route('note.edit', $note) }}" class="btn btn-warning mt-2 col-4">Edit <i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('note.destroy', $note) }}" method="post" class="col-4 bd-danger">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mt-2 bd-danger"><i class="fas fa-trash"></i></button>
                        </form>

                        <a href="{{ route('share.create', $note) }}" class="btn btn-success mt-2 col-4">Share <i
                                class="fas fa-share"></i></a>


                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-secondary">{{ $note->author->name }}</h5>
                        <h3 class="card-text text-bold my-3">
                            {!! Illuminate\Support\Str::limit($note->text, 100, '(...)') !!}</h3>
                        <div class="btn btn-danger">{{ count($note->likes) }} <i class="fas fa-heart"></i>
                        </div>
                        <a href="{{ route('note.show', $note) }}" class="btn btn-primary ms-4">Read more</a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
