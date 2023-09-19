<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *  @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->user_id = Auth::id();
        $tag->save();

        return redirect()->route('contents.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->name = $request->input('name');
        $tag->user_id = Auth::id();
        $tag->save();

        return redirect()->route('contents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('contents.index');
    }
}