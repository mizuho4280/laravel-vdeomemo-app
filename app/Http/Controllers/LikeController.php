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
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }

    public function store($contentId)
    {
        content_users::create([
            'content_id' => $contentId,
            'user_id' => Auth::user(),
        ]);

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