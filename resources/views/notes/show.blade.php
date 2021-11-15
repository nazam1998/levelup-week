@extends('layouts.app')

@section('title', 'Global Notes')

@section('content')
    <div class="container mt-3">

        <h5 class="card-title text-secondary">{{ $note->author->name }}</h5>
        <p class="card-text text-bold my-3">
            {{ Illuminate\Support\Str::limit($note->text, 100, '(...)') }}</p>



    </div>
    </div>
    </div>
    </div>

@endsection
