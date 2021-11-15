@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="container mt-3 mx-auto">
        <h1>Tags</h1>
        <div class="text-center"><a href="{{ route('tag.create') }}" class="btn btn-primary">Ajouter un tag</a></div>
        <div class="row mt-4">
            @foreach ($tags as $tag)
                <div class="col-2 border m-3">
                    <form action="{{ route('tag.destroy', $tag) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <span>
                            {{ Illuminate\Support\Str::limit($tag->name, 100, '(...)') }}</span>
                        <a href="{{ route('tag.edit', $tag) }}" class="btn text-warning"><i class="fas fa-pen"></i></a>
                        <button class="btn text-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    </div>

@endsection
