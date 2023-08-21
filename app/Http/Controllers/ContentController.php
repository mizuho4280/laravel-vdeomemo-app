<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    public function index(Request $request)
    {

        $search = $request->input('search');

        $query = Content::query();

        if (!empty($search)) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        $sort = $request->get('sort');
        if ($sort) {
            if ($sort == 'asc') {
                $contents = Content::latest()->paginate(2);
            } elseif ($sort == 'desc') {
                $contents = Content::oldest()->paginate(2);
            }
        } else {
            $contents = Content::all();
        }



        return view('contents.index', compact('contents'), ['sort' => $sort, 'contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'url' => 'required|max:11|min:11',
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.max:11' => '動画IDは11字です',
                'url.min:11' => '動画IDは11字です'
            ]
        );

        $request->validate(
            [
                'title' => 'required',
                'url' => 'required|max:11|min:11',
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.max:11' => '動画IDは11字です',
                'url.min:11' => '動画IDは11字です'
            ]
        );


        $content = new Content();
        $content->title = $request->input('title');
        $content->url = $request->input('url');
        $content->body = $request->input('body');
        $content->user_id = Auth::id();
        $content->save();

        return redirect()->route('contents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return view('contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {

        return view('contents.edit', compact('content'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {

        $request->validate(
            [
                'title' => 'required',
                'url' => 'required|max:11|min:11',
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.max:11' => '動画IDは11字です',
                'url.min:11' => '動画IDは11字です'
            ]
        );


        $request->validate(
            [
                'title' => 'required',
                'url' => 'required|max:11|min:11',
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.max:11' => '動画IDは11字です',
                'url.min:11' => '動画IDは11字です'
            ]
        );

        $content->title = $request->input('title');
        $content->url = $request->input('url');
        $content->body = $request->input('body');
        $content->save();

        return redirect()->route('contents.show', $content)->with('flash_message', '投稿を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('contents.index');
    }


}