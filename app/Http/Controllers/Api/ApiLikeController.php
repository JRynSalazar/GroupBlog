<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;

class ApiLikeController extends Controller
{
     public function toggleLike(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:post_comment,post_id',
        ]);

        $userId = auth()->id();
        $postId = $request->post_id;

        $existingLike = Like::where('post_id', $postId)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'Post unliked successfully.']);
        } else {
            Like::create([
                'post_id' => $postId,
                'user_id' => $userId,
            ]);
            return response()->json(['message' => 'Post liked successfully.']);
        }
    }

    // Get total like count for a post
    public function getLikes($postId)
    {
        $likeCount = Like::where('post_id', $postId)->count();

        return response()->json([
            'post_id' => $postId,
            'like_count' => $likeCount
        ]);
    }
}
