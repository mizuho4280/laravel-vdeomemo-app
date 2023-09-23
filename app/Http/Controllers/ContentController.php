<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tags = Auth::user()->tags;

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
            $contents = $query->where('user_id', Auth::id())->paginate(2);

        }

        $memo_status = Auth::user()->memo_status;



        return view('contents.index', compact('contents', 'tags'), ['sort' => $sort, 'contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Auth::user()->tags;

        return view('contents.create', compact('tags'));
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
                'url' => ['required', 'regex:/^[0-9a-zA-Z]{11}$/'],
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.regex' => '動画IDは半角英数字11字です',
            ],
        );



        $content = new Content();
        $content->title = $request->input('title');
        $content->url = $request->input('url');
        $content->body = $request->input('body');
        $content->user_id = Auth::id();
        $content->memo_status = $request->input('memo_status');
        $content->save();


        $content->tags()->sync($request->input('tag_ids'));

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


        $tags = Auth::user()->tags;
        $memo_status = Auth::user()->memo_status;

        return view('contents.show', compact('content', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $tags = Auth::user()->tags;
        return view('contents.edit', compact('content', 'tags'));

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
                'url' => ['required', 'regex:/^[0-9a-zA-Z]{11}$/'],
                'body' => 'nullable',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'url.required' => '動画IDは必須です',
                'url.regex' => '動画IDは半角英数字11字です',
            ],
        );

        $content->title = $request->input('title');
        $content->url = $request->input('url');
        $content->body = $request->input('body');
        $content->memo_status = $request->input('memo_status');
        $content->save();

        $content->tags()->sync($request->input('tag_ids'));

        return redirect()->route('contents.show', $content)->with('flash_message', 'メモを編集しました。');
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

        return redirect()->route('contents.index')->with('flash_message', 'メモを削除しました。');
    }


}