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
    try {
        if (empty($postId)) {
            return response()->json(['error' => 'Post ID is required'], 400);
        }

        if (!\App\Models\ApiComment::find($postId)) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $replies = PostCommentReply::where('post_id', $postId)->get();

        return response()->json([
            'message' => 'Replies fetched successfully.',
            'data' => $replies
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while retrieving replies.',
            'details' => $e->getMessage()
        ], 500);
    }
}

public function updateReply(Request $request, $id)
{
    try {
        if (empty($id)) {
            return response()->json(['error' => 'Reply ID is required'], 400);
        }

        $reply = PostCommentReply::find($id);

        if (!$reply) {
            return response()->json(['error' => 'Reply not found'], 404);
        }

        if ($reply->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        $reply->comment = $validated['comment'];
        $reply->save();

        return response()->json([
            'message' => 'Reply updated successfully',
            'data' => $reply
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while updating the reply',
            'details' => $e->getMessage()
        ], 500);
    }
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
