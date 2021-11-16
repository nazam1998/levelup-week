@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">
        <h2>Filter by tag</h2>
        @if (count($tags) != 0)
            <form action="{{ route('filter') }}" method="post">
                @csrf
                <div class=" row">
                    <div class="col-1 active-tag rounded tags mx-1">All</div>
                    @foreach ($tags as $tag)
                        <div class="col-1 inactive-tag rounded tags mx-1">{{ $tag->name }}</div>
                        <input type="hidden" name="tags[]" value="{{ $tag->name }}">
                    @endforeach
                    <br>
                    <div class="row col-12 mt-2 container">
                        <button id="filter-tag" class="btn btn-primary col-1" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        @else
            <h4 class="text-warning">Please add tag</h4>
        @endif

        <h1>All notes</h1>
        <div class="row" id="all-notes">
            @foreach ($notes as $note)
                <div class="card @if (Auth::id() == $note->author_id)bg-light @endif">
                    <div class="card-header row w-100 mt-3 mx-1">
                        @foreach ($note->tags as $tag)
                            <span class="col-1 col-xs-2 rounded bg-danger text-white tag-note">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! Illuminate\Support\Str::limit($note->text, 100, '(...)') !!}</p>
                        <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary ms-4">Read more</a>
                    </div>
                    <div class="card-footer bg-light">
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scriptjs')
    <script src="{{ asset('js/tag-filter.js') }}" defer></script>
@endsection
