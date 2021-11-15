<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('mobile')->only('index');
    }

    public function index()
    {
        $tags = Tag::all();
        $notes = Note::orderByDesc('likes_count')->get();

        return view('welcome', compact('notes', 'tags'));
    }
}
