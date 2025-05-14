<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCommentReply;
use Illuminate\Support\Facades\Auth;

class PostCommentReplyController extends Controller
{
    public function store(Request $request, $post_id)
{
    $request->validate([
        'comment' => 'required|string|max:500',
    ]);

    if (!\App\Models\PostComment::find($post_id)) {
        return redirect()->back()->with('error', 'Post not found.');
    }

    PostCommentReply::create([
        'post_id' => $post_id,
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    $commentCount = PostCommentReply::where('post_id', $post_id)->count();

    return redirect()->back()->with('commentCount', $commentCount);
}

}
