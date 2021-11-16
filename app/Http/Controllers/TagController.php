<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'name' => 'required|unique:tags|max:50',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.index');
    }

    public function show(Tag $tag)
    {

        return redirect()->route('welcome');
    }

    public function filter(Request $request){
        if(!$request->tags == null){
            $tags = Tag::where('name', $request->tags)->get();
            $notes = $tags->pluck('notes');
            $related = $notes->first();
            if ($notes->first()) {

                foreach ($notes as $note) {
                    $related = $related->merge($note);
                }

                $notes = $related;
            }
        }else{
            return redirect()->route('welcome');
        }
        $tags = Tag::all();
        return  view('welcome', compact('tags', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:tags,name,' . $tag->id,
        ]);

        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if (count($tag->notes) == 0) {
            $tag->delete();
        }
        return redirect()->back();
    }
}
