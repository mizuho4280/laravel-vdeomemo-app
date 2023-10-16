<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\content_users;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['store', 'destroy']);
    }

    public function store($contentId)
    {

        // content_users::create([
        //     'content_id' => $contentId,
        //     'user_id' => Auth::user(),
        // ]);

        $content_users = new content_users();
        $content_users->content_id = $contentId;
        $content_users->user_id = Auth::id();
        $content_users->save();


        session()->flash('success', 'You Liked the Reply.');

        return redirect()->back();
    }
    public function destroy($contentId)
    {
        $like = content_users::where('content_id', $contentId)->where('user_id', Auth::user())->first();
        $like->delete();


        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();

    }
}