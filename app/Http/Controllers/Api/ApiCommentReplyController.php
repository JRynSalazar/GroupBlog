<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCommentReply;
use Illuminate\Support\Facades\Auth;


class ApiCommentReplyController extends Controller
{
    public function storeReply(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:post_comment,post_id',
        'comment' => 'required|string',
    ]);

    $reply = PostCommentReply::create([
        'post_id' => $request->post_id,
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    return response()->json([
        'message' => 'Reply added successfully.',
        'data' => $reply
    ], 201);
}
public function getRepliesByPost($postId)
{
    $replies = PostCommentReply::where('post_id', $postId)->get();

    return response()->json([
        'message' => 'Replies fetched successfully.',
        'data' => $replies
    ]);
}
public function updateReply(Request $request, $id)
{
    $reply = PostCommentReply::find($id);

    if (!$reply) {
        return response()->json(['message' => 'Reply not found'], 404);
    }

    if ($reply->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $request->validate([
        'comment' => 'required|string'
    ]);

    $reply->comment = $request->comment;
    $reply->save();

    return response()->json([
        'message' => 'Reply updated successfully',
        'data' => $reply
    ]);
}

public function deleteReply($id)
{
    $reply = PostCommentReply::find($id);

    if (!$reply) {
        return response()->json(['message' => 'Reply not found'], 404);
    }

    if ($reply->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $reply->delete();

    return response()->json(['message' => 'Reply deleted successfully']);
}

}
