@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h1>All notes</h1>
        <div class="row">
            @foreach ($notes as $note)
                <div class="card col-3 mx-1" style="width: 18rem;">
                    <div class="row w-100 mt-3 mx-1">
                        @foreach ($note->tags as $tag)
                        <span class="col-3 rounded bg-danger text-white">{{$tag->name}}</span>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Illuminate\Support\Str::limit($note->text, 100, '(...)') }}</p>
                        <a href="{{route('like',$note)}}" class="btn btn-danger">{{ count($note->likes) }} <i class="fas fa-heart"></i></a>
                        <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary ms-4">Read more</a>
                    </div>
                    <span class="card-title">By {{ $note->author->name }}</span>
                </div>
            @endforeach
        </div>
    </div>

@endsection
