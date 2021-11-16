@extends('layouts.app')

@section('title', 'My Profil')

@section('content')
    <div class="container mx-auto mt-5">

        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/'.$user->image) }}" class="card-img-top" alt="No Profile Image Found">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $user->name }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Description: {{ $user->description }}</p>
            </div>
        </div>
    </div>

@endsection
