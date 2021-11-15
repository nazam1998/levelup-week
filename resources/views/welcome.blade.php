@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h2>Filter by tag</h2>
        <div class="container row">
            @foreach ($tags as $tag)
                <div class="col-1 inactive-tag rounded tags">{{ $tag->name }}</div>
            @endforeach
        </div>

        <h1>All notes</h1>
        <div class="row">
            @foreach ($notes as $note)
                <div class="card col-3 mx-1 @if (Auth::id() == $note->author_id)bg-light @endif" style="width: 18rem;">
                    <div class="row w-100 mt-3 mx-1">
                        @foreach ($note->tags as $tag)
                            <span class="col-3 rounded bg-danger text-white tag-note">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Illuminate\Support\Str::limit($note->text, 100, '(...)') }}</p>

                        @auth
                            @if (Auth::id() == $note->author_id)
                                <div class="btn text-danger like-button">{{ count($note->likes) }} <i
                                        class="fas fa-heart"></i></div>
                            @else
                                <a href="{{ route('like', $note) }}"
                                    class="btn @if (Auth::user()->likes->contains($note->id))btn-danger @else text-danger @endif">{{ count($note->likes) }} <i
                                        class="fas fa-heart"></i></a>
                            @endif
                        @else
                            <div class="btn text-danger like-button">{{ count($note->likes) }} <i class="fas fa-heart"></i>
                            </div>
                        @endauth
                        <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary ms-4">Read more</a>
                    </div>
                    <span class="card-title">By {{ $note->author->name }}</span>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scriptjs')
 <script src="{{asset('js/tag-filter.js')}}" defer></script>
@endsection
