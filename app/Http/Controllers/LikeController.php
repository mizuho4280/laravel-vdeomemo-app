<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\ContentUser;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['store', 'destroy']);
    }

    public function store($contentId)
    {


        $content_users = new ContentUser();
        $content_users->content_id = $contentId;
        $content_users->user_id = Auth::id();
        $content_users->save();

        return redirect()->back();
    }
    public function destroy($contentId)
    {
        $like = ContentUser::where('content_id', $contentId)->where('user_id', Auth::id())->first();
        $like->delete();


        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();

    }
}