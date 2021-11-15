<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $notes = Note::get();

        $notes->sortByDesc(function ($notes) {
            return $notes->likes->sum('user_id');
        });

        return view('welcome', compact('notes'));

    }
}
