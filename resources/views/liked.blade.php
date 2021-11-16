@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h1>Liked Notes</h1>
        <div class="row">
            @foreach ($notes as $note)
                <div class="card col-3 mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $note->author->name }}</h5>
                        <p class="card-text">{!! Illuminate\Support\Str::limit($note->text, 100, '(...)') !!}</p>
                        <a href="{{route('like', $note)}}" class="btn btn-danger">{{ count($note->likes) }} <i class="fas fa-heart"></i></a>
                        <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary ms-4">Read more</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
