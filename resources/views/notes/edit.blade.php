@extends('layouts.app')

@section('title', 'Add Note')

@section('content')

    <h1 class="text-center">Edit note</h1>

    <div class="container">
        <form action={{ route('note.update', $note) }} method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                @error('text')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <label for="text" class="form-label">Write your note</label>
                <textarea class="form-control" name="text" id="editor"
                    aria-describedby="text-note">{{ $note->text }}</textarea>
            </div>
            <div class="row my-4">
                <h4 class="col-3">Tags</h4><a href="{{ route('tag.create') }}"
                    class="btn btn-primary offset-2 col-2"> Add new tag</a>
            </div>

            @if (Session::has('msg'))
                <p class="text-danger">{{ Session('msg') }}</p>
            @endif
            @error('tags')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="container row my-4">

                @foreach ($tags as $tag)
                    <div class="mb-3 form-check col-1">
                        <input @if ($note->tags->contains($tag->id))checked @endif type="checkbox" class="form-check-input" name="tags[]"
                            value="{{ $tag->id }}" id="tags">
                        <label class="form-check-label" for="exampleCheck{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection


@section('scriptjs')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection