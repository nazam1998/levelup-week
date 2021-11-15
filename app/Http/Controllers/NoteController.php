<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show, index');
        $this->middleware('editor')->only('edit, update');
        $this->middleware('mobile')->only('liked');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        if ($tags->count() < 1) {
            return redirect()->route('tag.create');
        }
        return view('notes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|max:300',
            'tags.*' => 'required'
        ]);
        if ($request->tags == null) {
            return redirect()->back()->with(['msg' => 'At least one tag is required']);
        }
        $note = new Note;
        $note->text = $request->text;
        $note->author_id = Auth::id();
        $note->save();
        $note->tags()->attach($request->tags);

        return redirect()->route('note.index');
    }

    public function like(Note $note)
    {
        if (count(Auth::user()->likes) <= 10) {
            if (Auth::user()->likes->contains($note->id)) {
                Auth::user()->likes()->detach($note);
                $note->likes_count--;
                $note->save();
                return redirect()->back()->with(['msg' => "The note has been removed to your liked notes"]);
            } else {
                Auth::user()->likes()->attach($note);
                $note->likes_count++;
                $note->save();
                return redirect()->back()->with(['msg' => "The note has been added to your liked notes"]);
            }
        } else {
            return redirect()->back()->with(['msg' => "You cannot like more 10 notes"]);
        }
    }

    public function liked()
    {
        $notes = Auth::user()->likes;
        // dd($notes);
        return view('liked', compact('notes'));
    }

    public function mynotes()
    {
        $notes = Note::where('author_id', Auth::id())->get();

        return view('perso', compact('notes'));
    }

    public function sharecreate(Note $note)
    {
        $users = User::all()->except(Auth::id());
        return view('shares.create', compact('users', 'note'));
    }
    public function share(Request $request, Note $note)
    {
        if ($note->author_id == Auth::id()) {
            $note->shared()->detach();
            $note->shared()->attach($request->users, ['author_id' => Auth::id()]);
            return redirect()->back()->with(['msg' => "The note has been shared with mentionned users"]);
        } else {
            return redirect()->back()->with(['msg' => "You can't share other users' note"]);
        }
    }

    public function shared()
    {
        $notes = Auth::user()->shared;
        return view('shared', compact('notes'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $tags = Tag::all();
        if ($tags->count() < 1) {
            return redirect()->route('tag.create');
        }
        return view('notes.edit', compact('note', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'text' => 'required|max:300',
            'tags.*' => 'required'
        ]);

        $note->text = $request->text;
        $note->save();
        $note->tags()->detach();
        $note->tags()->attach($request->tags);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->back();
    }
}
